@extends('layout.app')
@section('title')
    Voltra | {{$category->slug}}| {{$product->slug}}@if($variant!= null)| {{$variant->color}} @endif
@endsection
@section('content')
    <main class="wrap" id="pd">
        <nav class="crumbs" style="padding-top:18px"><a href="{{route('index')}}">Ana Sayfa</a>
            › <a href="{{route('category.index',$category->slug)}}">{{$category->slug}}</a>
            › <a href="{{ route('product.index', ['category' => $category->slug,'product' => $product->slug]) }}">{{$product->slug}}</a>
            @if($variant!= null)
                › <span>{{$variant->color}}</span>
            @endif
        </nav>
        <div class="pd">
            <div class="gallery">
                <div class="main"><img id="mainImg" src="img/bilgisayar.jpg" alt="{{$product->name}}"></div>
                <div class="thumbs"><button class="active" data-img="img/bilgisayar.jpg"><img src="img/bilgisayar.jpg" alt=""></button><button class="" data-img="img/monitor.jpg"><img src="img/monitor.jpg" alt=""></button><button class="" data-img="img/aksesuar.jpg"><img src="img/aksesuar.jpg" alt=""></button></div>
            </div>
            <div>
                <span class="brand" style="font-size:12px;color:var(--muted)">@if($product->getBrand!=null){{$product->getBrand->name}} @endif</span>
                <h1>{{$product->name}} @if($variant!= null)| {{$variant->color}}@endif</h1>
                <div class="rating">★ 4.7 <span class="muted">(128 değerlendirme)</span></div>
                @if($variant!= null)
                    <div class="price-row" style="margin:16px 0">
                        @if($variant->price==$variant->discount_price or $variant->discount_price==null)
                            <span class="price" style="font-size:28px">{{$variant->price}}</span>
                        @else
                            <span class="price" style="font-size:28px">{{$variant->discount_price}}</span>
                            <span class="price-old">{{$variant->price}}</span><span class="badge badge-danger">%{{(($variant->price-$variant->discount_price)/$variant->price)*100}} indirim</span>
                        @endif

                    </div>
                @else
                    <div class="price-row" style="margin:16px 0">
                        @if($product->price==$product->discount_price or $product->discount_price==null)
                            <span class="price" style="font-size:28px">{{$product->price}}</span>
                        @else
                            <span class="price" style="font-size:28px">{{$product->discount_price}}</span>
                            <span class="price-old">{{$product->price}}</span><span class="badge badge-danger">%{{(($product->price-$product->discount_price)/$product->price)*100}} indirim</span>
                        @endif

                    </div>

                @endif

                <div>
                    <h4 style="font-size:13px;text-transform:uppercase;color:var(--muted)">Renk</h4>

                    <div class="variants" id="variants">
                        @if($getvariant!= null)
                            @foreach($getvariant as $v)
                                <a @if($variant== $v)class="variant active " @else class= "variant " @endif  href="{{ route('product.index', ['category' => $category->slug,'product' => $product->slug,$v->id]) }}">{{$v->color}}</a>
                            @endforeach
                        @endif
                    </div>
                </div>


                <div style="display:flex;gap:10px;align-items:center;margin-top:22px;flex-wrap:wrap">
                    <div class="qty"><button id="minus">−</button><span id="qty">1</span><button id="plus">+</button></div>
                    <button class="btn btn-lg" id="addBtn">Sepete ekle</button>
                    <button class="btn btn-outline btn-lg" id="favBtn">♡ Favorilere ekle</button>
                </div>
                <p style="font-size:13px;margin-top:10px" class="muted">Stokta 12 adet — bugün kargoda</p>
                <ul class="info-list">
                    <li>🚚 2.500 TL üzeri ücretsiz kargo</li>
                    <li>🛡️ 24 ay distribütör garantisi</li>
                    <li>↩️ 14 gün içinde koşulsuz iade</li>
                </ul>
            </div>
        </div>

        <div class="tabs">
            <a class="active" data-tab="desc">Ürün Açıklaması</a>
            <button data-tab="spec">Teknik Özellikler</button>
            <button data-tab="ship">Teslimat &amp; İade</button>
        </div>
        <div class="tab-panel" id="tabPanel"><p>Fansız tasarım, 18 saat pil ömrü ve distribütör garantisiyle ultra taşınabilir dizüstü.</p></div></main>

@endsection
