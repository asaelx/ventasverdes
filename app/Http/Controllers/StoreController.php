<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use App\Quantity;
use App\Variation;
use App\Category;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;

// Boxes
use App\Box;
use App\BPBox;
use App\BPItem;
use DVDoug\BoxPacker\Packer as BPPacker;

// Conekta
use Conekta\Conekta;
use Conekta\Charge;
use Conekta\Customer;
use Conekta\Order;

class StoreController extends Controller
{
    protected $create_address_url = 'https://app.mienvio.mx/api/addresses';
    protected $create_shipment_url = 'https://app.mienvio.mx/api/shipments';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::take(4)->get();
        return view('store.home.index', compact('products'));
    }

    /**
     * Shows the shopping cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCart()
    {
        $cart = $this->getCart();
        return view('store.cart.index', compact('cart'));
    }

    /**
     * Stores a cart in the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeCart(CartRequest $request)
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
     * Update cart quantities
     *
     * @param  Request $request
     * @param  Cart    $cart
     * @return redirect
     */
    public function updateCart(Request $request, Cart $cart)
    {
        $subtotal = 0;
        foreach ($request->input('quantities') as $id => $item) {
            $quantity = Quantity::find($id);
            if($quantity){
                $quantity->update($item);
            }else{
                $quantity = $cart->quantities()->create([
                    'quantity' => $item['quantity'],
                    'variation_id' => $item['variation_id']
                ]);
            }
            $variation = Variation::find($item['variation_id']);
            $price = (!is_null($variation->sale_price)) ? $variation->sale_price : $variation->regular_price;
            $subtotal = $subtotal + ($item['quantity'] * $price);
        }

        $cart->update(['subtotal' => $subtotal]);

        return back();
    }

    /**
     * Remove the specified item from cart. (ajax)
     *
     * @param  Quantity $quantity
     * @return \Illuminate\Http\Response
     */
    public function destroyItem(Quantity $quantity)
    {
        if($quantity->delete()){
            session()->flash('flash_message', 'Se ha eliminado el producto del carrito');
            return response('success', 200);
        }
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
                if($session_cart){
                    foreach ($session_cart->quantities as $session_quantity) {
                        $session_quantity->update(['cart_id' => $cart->id]);
                    }
                    $session_cart->delete();
                }
                session()->forget('cart');
                $cart = Auth::user()->cart()->first();
            }
        }else{
            if(session()->has('cart')){
                $cart = Cart::where('session', session('cart'))->first();
            }else{
                session(['cart' => time().str_random(14)]);
            }

            if(!isset($cart) || !$cart)
                $cart = Cart::create(['session' => session('cart')]);
        }

        return $cart;
    }

    /**
     * Shows the checkout.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckout()
    {
        $cart = $this->getCart();
        $countries = $this->getCountries();
        $states = $this->getStates('México');
        $cities = $this->getCities('AGUASCALIENTES');

        return view('store.checkout.checkout', compact('cart', 'countries', 'states', 'cities'));
    }

    private function getPackedBoxes($cart)
    {
        $sellers = [];

        foreach ($cart->quantities as $item) {
            $product = $item->variation;
            $user = $product->product->first()->user;

            $sellers[$user->id]['user'] = $user;
            $sellers[$user->id]['products'][$product->id]['title'] = $product->title;
            $sellers[$user->id]['products'][$product->id]['length'] = $product->length;
            $sellers[$user->id]['products'][$product->id]['height'] = $product->height;
            $sellers[$user->id]['products'][$product->id]['width'] = $product->width;
            $sellers[$user->id]['products'][$product->id]['weight'] = $product->weight;
            $sellers[$user->id]['total_weight'] = (isset($sellers[$user->id]['total_weight'])) ? $sellers[$user->id]['total_weight'] + $product->weight : $product->weight;
        }

        foreach ($sellers as $id => $seller) {
            $packer = new BPPacker();
            foreach ($seller['user']->boxes as $box) {
                $outerWidth = $box->width * 10;
                $outerLength = $box->length * 10;
                $outerDepth = $box->height * 10;
                $emptyWeight = $box->weight * 1000;
                $innerWidth = $outerWidth - 10;
                $innerLength = $outerLength - 10;
                $innerDepth = $outerDepth - 10;
                $maxWeight = 64000;
                $packer->addBox(new BPBox($box->name, $outerWidth, $outerLength, $outerDepth, $emptyWeight, $innerWidth, $innerLength, $innerDepth, $maxWeight));
            }
            foreach ($seller['products'] as $product) {
                $width = $product['width'] * 10;
                $length = $product['length'] * 10;
                $height = $product['height'] * 10;
                $weight = $product['weight'] * 1000;
                $packer->addItem(new BPItem($product['title'], $width, $length, $height, $weight, true));
            }
            $allPackedBoxes[$id]['packedBoxes'] = $packer->pack();
            $allPackedBoxes[$id]['user'] = $seller['user'];
        }

        return $allPackedBoxes;
    }

    public function continueToShipping(Request $request)
    {
        $cart = $this->getCart();
        $allPackedBoxes = $this->getPackedBoxes($cart);
        $user = Auth::user();
        $profile = $user->profile;

        if($request->input('address_option') == 'custom'){
            $shipping = $request->input('shipping');
            $data_to = [
                'object_type' => 'TO',
                'street' => $shipping['address'],
                // 'street2' => $shipping['address2'],
                'name' => $shipping['firstname'] . ' ' . $shipping['lastname'],
                'email' => $shipping['email'],
                'phone' => $shipping['phone'],
                'zipcode' => $shipping['zipcode'],
                'alias' => $cart->id
            ];
            $address_to = $this->getAddress($data_to);
        }elseif(is_numeric($request->input('address_option'))){
            $address = $profile->addresses()->find($request->input('address_option'));
            $shipping = [
                'firstname' => $profile->firstname,
                'lastname' => $profile->lastname,
                'address' => $address->address,
                'country' => 'MX',
                'state' => $address->state,
                'city' => $address->city,
                'zipcode' => $address->zipcode,
                'phone' => $profile->phone,
                'email' => $user->email
            ];
            $address_to = $address->mienvio_object_id;
        }

        if($request->input('billing_option') == 'custom'){
            $billing = $request->input('billing');
        }else if($request->input('billing_option') == 'same'){
            $billing = $shipping;
        }

        $addresses_from = $this->getAddressesFrom($allPackedBoxes);

        $all_rates = $this->getShipmentRates($addresses_from, $address_to);

        $items = [];

        foreach ($cart->quantities as $quantity) {
            $price = (is_null($quantity->sale_price)) ? $quantity->regular_price : $quantity->sale_price;
            $item = [
                'name' => $quantity->variation->product->first()->title . ' (' . $quantity->variation->title . ')',
                'unit_price' => $price,
                'quantity' => $quantity->quantity
            ];
            $items[] = $item;
        }

        return view('store.checkout.shipment', compact('cart', 'all_rates'));
    }

    public function placeOrder(Request $request)
    {
        dd($request->all());
    }

    private function getAddress($data)
    {
        $decoded_to = $this->callApi('POST', $this->create_address_url, $data);
        $address_to = $decoded_to->address->object_id;
        return $address_to;
    }

    public function getAddressesFrom($allPackedBoxes)
    {
        $addresses_from = [];

        foreach ($allPackedBoxes as $id => $data) {
            $address_from = $data['user']->profile->addresses->first()->mienvio_object_id;

            $addresses_from[$id]['address_from'] = $address_from;
            $addresses_from[$id]['packedBoxes'] = $data['packedBoxes'];
        }

        return $addresses_from;
    }

    /**
     * Process conekta payment
     *
     * @param  Array $shipping
     * @param  Array $billing
     * @param  Array $items
     * @param  String $payment
     * @return Order $order
     */
    private function conekta($shipping, $billing, $items, $rates, $payment)
    {
      Conekta::setApiKey(env('CONEKTA_SECRET'));
      Conekta::setApiVersion('2.0.0');
      Conekta::setLocale('es');

      $billing_name = $billing['firstname'] . " " . $billing['lastname'];

      $customer = Customer::create([
        'name' => $billing_name,
        'email' => $billing['email'],
        'phone' => $billing['phone'],
        'payment_sources' => [
            [
                'type' => 'card',
                'token_id' => 'tok_test_visa_4242'
            ]
        ]
      ]);

      // dd($customer->payment_sources->metadata->id);

    //   $line_items = [];
    //   $line_items = [
    //       [
    //           "name" => "Tacos",
    //           "unit_price" => 1000,
    //           "quantity" => 12
    //       ]
      //
    //   ];

      //Create array for line_items
      //name
      //unit_price
      //quantity

      $shipping_lines = [];
      $shipping_lines = [
          [
              "amount" => 1500,
              "carrier" => "mi compañia"
          ]
      ];
      //Create array with shipping details
      //amount
      //carrier

      $city = 'Merida';
      $state = 'Yucatan';
      $country = 'MX';

      $shipping = $request->input('shipping');

      $order = Order::create([
          'line_items' => $line_items,
          'shipping_lines' => $shipping_lines,
          'currency' => 'mxn',
          'customer_info' => [
                'customer_id' => $customer->id,
          ],
          'shipping_contact' => [
                'phone' => $shipping['phone'],
                'receiver' => $shipping['firstname'] . " " . $shipping['firstname'],
                'address' => [
                    'street1' => $shipping['address'],
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'postal_code' => $shipping['zipcode'],
                    'residential' => true
                ]
          ],
          'charges' => [
              [
                    'payment_source' => [
                        'id' => $customer->payment_sources->metadata->id,
                        'type' => 'card'
                  ]
              ]
          ]
      ]);

      dd($order);

    }

    /**
     * Shows the Thank You Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showThankyou()
    {
        $cart = $this->getCart();
        return view('store.checkout.thankyou', compact('cart'));
    }

    public function getShipmentRates($addresses_from, $address_to)
    {
        $shipments_ids = $this->createShipments($addresses_from, $address_to);

        $all_rates = [];

        foreach ($shipments_ids as $shipment_id) {
            $get_rates_url = $this->getRatesUrl($shipment_id);

            $decoded_rates = $this->callApi('GET', $get_rates_url);

            $rates = [];

            foreach($decoded_rates->results as $rate){
                $rates[$rate->object_id] = $rate->provider . ' ' . $rate->servicelevel . ' - ' . $rate->duration_terms . ' ($' . $rate->amount . ')'; 
            }

            $all_rates['rates'][] = $rates;
            $all_rates['shipment_id'] = $shipment_id;
        }

        return $all_rates;
    }

    public function createShipments($addresses_from, $address_to, $rate_id = null)
    {
        $decoded_shipments = [];

        foreach ($addresses_from as $id => $address_from) {
            foreach ($address_from['packedBoxes'] as $packedBox) {
                // Description
                $description = 'Envío '.time();

                $boxType = $packedBox->getBox();
                $data_shipment = [
                    'object_purpose' => 'QUOTE',
                    'address_from' => $address_from['address_from'],
                    'address_to' => $address_to,
                    'weight' => $packedBox->getWeight() / 1000,
                    'length' => $boxType->getOuterLength() / 10,
                    'height' => $boxType->getOuterDepth() / 10,
                    'width' => $boxType->getOuterWidth() / 10,
                    'description' => $description
                ];
                if(!is_null($rate_id))
                    $data_shipment['rate'] = $rate_id;
                $decoded_shipments[] = $this->callApi('POST', $this->create_shipment_url, $data_shipment);
            }
        }

        $shipments_ids = [];

        foreach ($decoded_shipments as $decoded_shipment) {
            $shipments_ids[] = $decoded_shipment->shipment->object_id;
        }

        return $shipments_ids;
    }

    private function getRatesUrl($shipment_id)
    {
        return 'https://app.mienvio.mx/api/shipments/' . $shipment_id . '/rates';
    }

    public function getRateAmount($rate_id)
    {
        $rate_info = $this->callApi('GET', 'https://app.mienvio.mx/api/rates/' . $rate_id);
        return $rate_info->rate->amount;
    }

    private function callApi($method, $url, $data = false)
    {
        $curl = curl_init($url);

        $headers = ['authorization: Bearer ' . env('MIENVIO_KEY')];

        if($method == 'POST'){
            curl_setopt($curl, CURLOPT_POST, true);
            if($data){
                $data = http_build_query($data);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);

        curl_close($curl);

        $decoded = json_decode($curl_response);

        return $decoded;
    }

    public function getCountries()
    {
        $countries = ['México' => 'México'];
        return $countries;
    }

    public function getStates($country)
    {
        $mexico_json = file_get_contents(asset('json/mexico.json'));
        $mexico_array = json_decode($mexico_json, true);
        $states = [];
        foreach ($mexico_array['México']['estado'] as $states_array) {
            $states[$states_array['nombre']] = $states_array['nombre'];
        }
        return $states;
    }

    public function getCities($state)
    {
        $mexico_json = file_get_contents(asset('json/mexico.json'));
        $mexico_array = json_decode($mexico_json, true);
        $cities = [];
        foreach ($mexico_array['México']['estado'] as $states_array) {
            if($states_array['nombre'] == $state){
                $municipios = $states_array['municipios']['municipio'];
                foreach ($municipios as $key => $municipio) {
                    $cities[$municipio['nombre']] = $municipio['nombre'];
                }
            }
        }
        return $cities;
    }

}
