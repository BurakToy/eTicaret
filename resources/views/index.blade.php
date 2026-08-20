@extends('layout.app')
@section('title')
    Voltra | Bilgisayar, Telefon ve Teknoloji Mağazası
@endsection
@section('content')
    <main>
        <section class="hero">
            <img class="bg" id="heroImg" src="img/hero-1.jpg" width="1600" height="700" alt="Voltra kampanya görseli">
            <div class="veil"></div>
            <div class="wrap inner">
                <span class="kicker" id="heroBadge">Yaz Kampanyası</span>
                <h1 id="heroTitle">NovaBook serisinde 5.000 TL'ye varan indirim</h1>
                <p id="heroText">Fansız tasarım, 18 saat pil ömrü ve 24 ay Türkiye garantisi.</p>
                <div style="margin-top:26px"><a class="btn btn-lg" id="heroCta" href="kategori.html?c=bilgisayar">Bilgisayarları incele →</a></div>
                <div class="dots">
                    <button class="arrow" id="heroPrev" aria-label="Önceki">‹</button>
                    <div class="pips" id="heroPips"></div>
                    <button class="arrow" id="heroNext" aria-label="Sonraki">›</button>
                </div>
            </div>
        </section>

        <section class="perks"><div class="wrap grid">
                <div class="perk"><span>🚚</span><div><strong>2.500 TL üzeri ücretsiz kargo</strong><span>Aynı gün kargo imkânı</span></div></div>
                <div class="perk"><span>🛡️</span><div><strong>Distribütör garantisi</strong><span>Tüm ürünlerde faturalı satış</span></div></div>
                <div class="perk"><span>↩️</span><div><strong>14 gün içinde iade</strong><span>Koşulsuz cayma hakkı</span></div></div>
            </div></section>

        <section class="section wrap">
            <div class="section-head"><h2>Öne çıkan kategoriler</h2></div>
            <div class="grid-cats" id="catGrid">
                @php
                    $categories=\App\Models\category::get();
                   $Parentcategories=\App\Models\category::has('children')->get();
                   $NonParentcategories=\App\Models\category::doesnthave('children')->wherenull('parent_id')->get();
                 @endphp


                @foreach($Parentcategories as $c)
                    <article class="cat-card"><a class="cat-main" href="{{route('category.index',$c->slug)}}"><div class="ico">💻</div><strong>{{$c->name}}</strong>
                            <span>açıklama</span>
                        </a><div class="cat-subs">
                            @foreach($categories as $b) @if($c->id==$b->parent_id) <a href="{{route('category.index',$b->slug)}}">{{$b->name}}</a>@endif @endforeach
                           </div></article>
                @endforeach


            </div>
        </section>
        <section class="section wrap" style="padding-top:0">
            <div class="section-head"><h2>Öne çıkanlar</h2><a href="kategori.html">Tümünü gör →</a></div>
            @php $featuredproducts=\App\Models\product::where('is_featured', 1)->get();                    @endphp
            <div class="grid-products" >
            @foreach($featuredproducts->take(4) as $p)
                @include('new.product')
            @endforeach
            </div>
        </section>
        <section class="section wrap" style="padding-top:0">
            <div class="section-head"><h2>Çok satanlar</h2><a href="kategori.html">Tümünü gör →</a></div>
                @php $bestsellerproducts=\App\Models\product::where('is_bestseller', 1)->get();                    @endphp
            <div class="grid-products" >
            @foreach($bestsellerproducts->take(4) as $p)
                @include('new.product')
                @endforeach
            </div>
        </section>
        <section class="section wrap" style="padding-top:0">
            <div class="section-head"><h2>Yeni ürünler</h2><a href="kategori.html">Tümünü gör →</a></div>
            @php $newproducts=\App\Models\product::where('is_new', 1)->get();                    @endphp
            <div class="grid-products" >
                @foreach($newproducts->take(4) as $p)
                    @include('new.product')
                @endforeach
            </div>
        </section>
        <section class="section wrap" style="padding-top:0">
            <div class="section-head"><h2>Kampanyalı ürünler</h2><a href="kategori.html?indirim=1">Tüm kampanyalar →</a></div>
            @php $campaignproducts=\App\Models\product::where('is_campaign', 1)->get();                    @endphp
            <div class="grid-products" >
            @foreach($campaignproducts->take(4) as $p)
                @include('new.product')
            @endforeach
            </div>
        </section>

    </main>
@endsection
