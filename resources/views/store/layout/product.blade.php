@php
    $on_sale = (is_null($product->variations->first()->sale_price)) ? false : true;
    $price = ($on_sale) ? $product->variations->first()->sale_price : $product->variations->first()->regular_price;
@endphp
<a href="{{ url('producto/'.$product->slug) }}" class="product">
    @if ($on_sale)
        <span class="on-sale">En oferta</span>
    @endif
    <img src="{{ asset('storage/' . $product->medias->first()->url) }}" alt="title" class="img">
    <div class="content">
        <h3 class="title">{{ $product->title }}</h3>
        <!-- /.title -->
        <div class="price">
            <span class="amount">${{ $price }}</span>
        </div>
        <!-- /.price -->
    </div>
    <!-- /.content -->
</a>
<!-- /.product -->
