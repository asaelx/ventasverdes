<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Cart;
use App\Quantity;

class CartController extends Controller
{
    /**
     * Shows the cart page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = $this->getCart();
        return view('store.cart.index', compact('cart'));
    }

    /**
     * Stores a cart in the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = $this->getCart();

        $product_exists = $cart->quantities()->where('variation_id', $request->input('variation_id'))->first();

        if($product_exists){
            $product_exists->quantity = $product_exists->quantity + $request->input('quantity');
            $product_exists->save();
        }else{
            $cart->quantities()
                ->create([
                    'quantity' => $request->input('quantity'),
                    'variation_id' => $request->input('variation_id'),
                    'cart_id' => $cart->id
                ]);
        }

        $cart = $this->getCart();

        $subtotal = 0;
        foreach ($cart->quantities as $quantity) {
            $price = (is_null($quantity->variation->sale_price)) ? $quantity->variation->regular_price : $quantity->variation->sale_price;
            $subtotal = $subtotal + ($quantity->quantity * $price);
        }

        $cart->update(['subtotal' => $subtotal]);

        session()->flash('flash_message', 'Se ha agregado tu producto al carrito');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Quantity $quantity
     * @return \Illuminate\Http\Response
     */
    public function destroyItem(Quantity $quantity)
    {
        $quantity->delete();

        $cart = $this->getCart();

        $subtotal = 0;
        foreach ($cart->quantities as $quantity) {
            $price = (is_null($quantity->variation->sale_price)) ? $quantity->variation->regular_price : $quantity->variation->sale_price;
            $subtotal = $subtotal + ($quantity->quantity * $price);
        }

        $cart->subtotal = $subtotal;
        $cart->save();

        session()->flash('flash_message', 'Se ha eliminado el producto del carrito');
        return back();
    }

    /**
     * Shows the checkout.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $cart = $this->getCart();
        return view('store.checkout.checkout', compact('cart'));
    }

    /**
     * Shows the Thank You Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function thankyou()
    {
        $cart = $this->getCart();
        return view('store.checkout.thankyou', compact('cart'));
    }

    /**
     * Get cart from database or create a new one.
     *
     * @return Cart $cart
     */
    private function getCart()
    {
        if (Auth::check()) {
            $cart = Auth::user()->cart()->first();
            if(!$cart){
                $cart = Auth::user()->cart()->create([
                    'user_id' => Auth::user()->id
                ]);
            }
            $quantities = $cart->quantities;

            if(session()->has('cart')){
                $session_cart = Cart::where('session', session('cart'))->first();
                foreach ($session_cart->quantities as $session_quantity) {
                    foreach ($quantities as $quantity) {
                        if($quantity->variation_id == $session_quantity->variation_id){
                            $new_quantity = $session_quantity->replicate();
                            $new_quantity->cart_id = $cart->id;
                            $new_quantity->quantity = $session_quantity->quantity + $quantity->quantity;
                            $new_quantity->save();
                        }
                    }
                    $session_quantity->cart_id = $cart->id;
                    $session_quantity->save();
                }
                $session_cart->delete();
                session()->forget('cart');
                $cart = Auth::user()->cart()->first();
            }
        }else{
            if(session()->has('cart')){
                $cart = Cart::where('session', session('cart'))->first();
            }else{
                session(['cart' => str_random(14)]);
                $cart = Cart::create([
                    'session' => session('cart')
                ]);
            }
        }

        return $cart;
    }
}
