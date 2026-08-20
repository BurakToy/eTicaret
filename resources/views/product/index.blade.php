@extends('layout.app')
@section('title')
    Voltra | {{$category->slug}}| {{$product->slug}}@if($variant!= null)| {{$variant->slug}} @endif
@endsection
@section('content')
    <main class="wrap" id="pd">
        <nav class="crumbs" style="padding-top:18px"><a href="index.html">Ana Sayfa</a> › <a href="kategori.html?c=bilgisayar">Bilgisayar</a> › <a href="kategori.html?c=bilgisayar&amp;s=dizustu">Dizüstü Bilgisayar</a> › <span>NovaBook Air 14 M3 16GB 512GB</span></nav>
        <div class="pd">
            <div class="gallery">
                <div class="main"><img id="mainImg" src="img/bilgisayar.jpg" alt="NovaBook Air 14 M3 16GB 512GB"></div>
                <div class="thumbs"><button class="active" data-img="img/bilgisayar.jpg"><img src="img/bilgisayar.jpg" alt=""></button><button class="" data-img="img/monitor.jpg"><img src="img/monitor.jpg" alt=""></button><button class="" data-img="img/aksesuar.jpg"><img src="img/aksesuar.jpg" alt=""></button></div>
            </div>
            <div>
                <span class="brand" style="font-size:12px;color:var(--muted)">NovaBook</span>
                <h1>NovaBook Air 14 M3 16GB 512GB</h1>
                <div class="rating">★ 4.7 <span class="muted">(128 değerlendirme)</span></div>
                <div class="price-row" style="margin:16px 0">
                    <span class="price" style="font-size:28px">₺42.999</span>
                    <span class="price-old">₺47.999</span><span class="badge badge-danger">%10</span>
                </div>
                <div>
                    <h4 style="font-size:13px;text-transform:uppercase;color:var(--muted)">Renk</h4>
                    <div class="variants" id="variants"><button class="variant active" data-variant="Uzay Grisi">Uzay Grisi</button><button class="variant " data-variant="Gümüş">Gümüş</button></div>
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
            <button class="active" data-tab="desc">Ürün Açıklaması</button>
            <button data-tab="spec">Teknik Özellikler</button>
            <button data-tab="ship">Teslimat &amp; İade</button>
        </div>
        <div class="tab-panel" id="tabPanel"><p>Fansız tasarım, 18 saat pil ömrü ve distribütör garantisiyle ultra taşınabilir dizüstü.</p></div></main>
@endsection
