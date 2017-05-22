<h2 class="title">Resumen de compra</h2>
<!-- /.title -->
<div class="summary">
    <table class="table">
        <thead class="thead">
            <tr class="tr">
                <th class="th">Producto</th>
                <!-- /.th -->
                <th class="th">Total</th>
                <!-- /.th -->
            </tr>
            <!-- /.tr -->
        </thead>
        <!-- /.thead -->
        <tbody>
            @if (!$cart->quantities->isEmpty())
                @foreach ($cart->quantities as $item)
                    @php
                        $price = (!is_null($item->variation->sale_price)) ? $item->variation->sale_price : $item->variation->regular_price;
                        $title = ($item->variation->product->first()->variations->count() > 1) ? $item->variation->product->first()->title . ' (' . $item->variation->title . ')' : $item->variation->product->first()->title;
                    @endphp
                    <tr>
                        <td><span class="title">{{ $title }} ({{ $item->quantity }})</span></td>
                        <td>
                            <span class="price">
                                <span class="currency-symbol">$</span>
                                <span class="product-total">{{ currency($item->quantity * $price) }}</span>
                            </span>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <!-- /.table -->
    <div class="totals">
        <div class="subtotal row">
            <div class="col-8"><span class="title">Subtotal</span></div>
            <!-- /.col-8 -->
            <div class="col-4">
                <span class="price">
                    <span class="currency-symbol">$</span>
                    <span class="subtotal-price" data-subtotal="{{ $cart->subtotal }}">{{ currency($cart->subtotal) }}</span>
                </span>
            </div>
            <!-- /.col-4 -->
        </div>
        <!-- /.subtotal -->

        <div class="shipping row">
            <div class="col-8"><span class="title">Envío</span></div>
            <!-- /.col-8 -->
            <div class="col-4">
                <span class="price">
                    <span class="currency-symbol">$</span>
                    <span class="shipment-price">—</span>
                </span>
            </div><!-- /.col-4 -->
        </div>
        <!-- /.shipping -->

        <div class="service row">
            <div class="col-8"><span class="title">Comisión del Servicio</span></div>
            <!-- /.col-8 -->
            <div class="col-4">
                <span class="price">
                    <span class="currency-symbol">$</span>
                    <span class="service-price">—</span>
                </span>
            </div><!-- /.col-4 -->
        </div>
        <!-- /.service -->

        <div class="total row">
            <div class="col-8"><span class="title">Total</span></div>
            <!-- /.col-8 -->
            <div class="col-4">
                <span class="price">
                    <span class="currency-symbol">$</span>
                    <span class="total-price">—</span>
                </span>
            </div>
            <!-- /.col-4 -->
        </div>
        <!-- /.total -->

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-green" id="submit">{{ $submit }}</button>
            </div>
            <!-- /.col-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.totals -->
</div>
<!-- /.summary -->
