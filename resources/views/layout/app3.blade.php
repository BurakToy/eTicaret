bu blade bootstrapin ilk hali
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
        <div class="grid-cats" id="catGrid"></div>
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

<script src="{{asset('panel/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('panel/js/data.js')}}"></script>
<script src="{{asset('panel/js/app.js')}}"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("catGrid").innerHTML = CATEGORIES.map(c =>
            `<article class="cat-card"><a class="cat-main" href="kategori.html?c=${c.slug}"><div class="ico">${c.icon}</div><strong>${c.name}</strong><span>${c.desc}</span></a><div class="cat-subs">${c.subcategories.map(sub => `<a href="kategori.html?c=${c.slug}&s=${sub.slug}">${sub.name}</a>`).join("")}</div></article>`).join("");

        const best = PRODUCTS.filter(p => p.tags.includes("cok-satan")).concat(PRODUCTS).slice(0, 4);
        const sale = PRODUCTS.filter(p => p.oldPrice).slice(0, 4);
        document.getElementById("bestGrid").innerHTML = best.map(productCard).join("");
        document.getElementById("saleGrid").innerHTML = sale.map(productCard).join("");
        bindCards();

        const slides = [
            { img: "img/hero-1.jpg", badge: "Yaz Kampanyası", title: "NovaBook serisinde 5.000 TL'ye varan indirim", text: "Fansız tasarım, 18 saat pil ömrü ve 24 ay Türkiye garantisi.", cta: "Bilgisayarları incele →", href: "kategori.html?c=bilgisayar" },
            { img: "img/hero-2.jpg", badge: "Yeni Sezon", title: "Helio X7 Pro şimdi stoklarda", text: "200MP kamera, LTPO ekran ve titanyum gövde.", cta: "Ürünü gör →", href: "urun.html?p=helio-x7-pro" },
            { img: "img/hero-3.jpg", badge: "Sınırlı Stok", title: "Ses sistemlerinde %20 indirim", text: "Adaptif gürültü engelleme ve 40 saat pil ömrü.", cta: "Kulaklıkları gör →", href: "kategori.html?c=ses" },
        ];
        let i = 0;
        const pips = document.getElementById("heroPips");
        pips.innerHTML = slides.map((_, n) => `<button class="pip" data-i="${n}" aria-label="${n + 1}. kampanya"></button>`).join("");
        function show(n) {
            i = (n + slides.length) % slides.length;
            const s = slides[i];
            heroBadge.textContent = s.badge; heroTitle.textContent = s.title; heroText.textContent = s.text;
            heroCta.textContent = s.cta; heroCta.href = s.href;
            document.getElementById("heroImg").src = s.img;
            pips.querySelectorAll(".pip").forEach((p, n2) => p.classList.toggle("active", n2 === i));
        }
        pips.onclick = (e) => { if (e.target.dataset.i) show(+e.target.dataset.i); };
        document.getElementById("heroPrev").onclick = () => show(i - 1);
        document.getElementById("heroNext").onclick = () => show(i + 1);
        show(0);
        setInterval(() => show(i + 1), 7000);
    });
</script>
</body>
</html>

