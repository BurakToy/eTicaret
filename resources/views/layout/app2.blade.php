<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voltra | Bilgisayar, Telefon ve Teknoloji Mağazası</title>
    <meta name="description" content="Dizüstü bilgisayar, akıllı telefon, tablet, monitör ve aksesuarlar Voltra'da. Distribütör garantili, 2.500 TL üzeri kargo bedava.">
    <link rel="icon" href="{{asset('panel/img/favicon.svg')}}" type="image/svg+xml">
    <link rel="stylesheet" href="{{asset('panel/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/css/style.css')}}">
</head>
<body>
<div id="site-header"></div>

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
            <article class="cat-card"><a class="cat-main" href="kategori.html?c=bilgisayar"><div class="ico">💻</div><strong>Bilgisayar</strong>
                    <span>Dizüstü, masaüstü ve oyuncu bilgisayarları</span>
                </a><div class="cat-subs">
                    <a href="kategori.html?c=bilgisayar&amp;s=dizustu">Dizüstü Bilgisayar</a>
                    <a href="kategori.html?c=bilgisayar&amp;s=oyuncu">Oyuncu Bilgisayarı</a>
                    <a href="kategori.html?c=bilgisayar&amp;s=profesyonel">Profesyonel İş İstasyonu</a></div></article>
        </div>
    </section>

    <section class="section wrap" style="padding-top:0">
        <div class="section-head"><h2>Çok satanlar</h2><a href="kategori.html">Tümünü gör →</a></div>
        <div class="grid-products" id="bestGrid"></div>
    </section>

    <section class="section wrap" style="padding-top:0">
        <div class="section-head"><h2>İndirimdeki ürünler</h2><a href="kategori.html?indirim=1">Tüm kampanyalar →</a></div>
        <div class="grid-products" id="saleGrid"></div>
    </section>
</main>

<div id="site-footer"></div>


</body>
</html>

