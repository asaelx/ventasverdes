<section id="results">
    <div class="wrapper">
        <header class="header">
            @if(isset($s))
                <div class="row">
                    <div class="col-12">
                        <h2 class="title">Se{{ ($products->count() > 1) ? ' encontraron ' : ' encontró ' }}<strong>{{ $products->count() }}</strong> producto{{ ($products->count() > 1) ? 's' : '' }}{!! ($s != '') ? ' para "<strong>' . $s . '</strong>"' : '.' !!}</h2>
                        <!-- /.title -->
                        <div class="display pull-right">
                            <ul class="list">
                                <li class="item toggle-sidebar-item">
                                    <a href="#" class="link toggle-sidebar">Mostrar filtros</a>
                                </li>
                                <!-- /.item -->
                                <li class="item">
                                    <button class="mode" data-type="list">
                                        <img src="{{ asset('img/display-list.svg') }}" alt="List" class="img">
                                    </button>
                                </li>
                                <!-- /.item -->
                                <li class="item">
                                    <button class="mode" data-type="grid">
                                        <img src="{{ asset('img/display-grid.svg') }}" alt="Grid" class="img">
                                    </button>
                                </li>
                                <!-- /.item -->
                            </ul>
                            <!-- /.list -->
                        </div>
                        <!-- /.display -->
                    </div>
                    <!-- /.col-12 -->
                </div>
                <!-- /.row -->
            @endif
        </header>
        <!-- /.header -->
        <div class="products grid">
            <div class="row">
                @if (!$products->isEmpty())
                    @foreach ($products as $product)
                        <div class="col-4">
                            @include('store.layout.product')
                        </div>
                        <!-- /.col-4 -->
                    @endforeach
                @endif
            </div>
            <!-- /.row -->
        </div>
        <!-- /.products -->
        <div class="pagination">
            <div class="row">
                <div class="col-12">
                    {{-- Pagination HTML --}}
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.pagination -->
    </div>
    <!-- /.wrapper -->
</section>
<!-- /#results -->
