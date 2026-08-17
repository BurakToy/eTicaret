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

<div class="accent-bar"></div>

<div class="site-header">
    <div class="wrap header-main">
        <button class="menu-btn" id="menuBtn" aria-label="Menü">☰</button>
        <a class="logo" href="index.html"><span class="logo-mark">V</span><span>Voltra</span></a>
        <div class="search">
            <span class="icon">🔍</span>
            <input id="searchInput" type="search" placeholder="Ürün, marka veya kategori ara" aria-label="Site içi arama" autocomplete="off">
            <div id="suggest" class="suggest hidden"></div>
        </div>
        <div class="header-actions">
            <a class="icon-btn" href="favoriler.html" aria-label="Favoriler">♡<span class="dot hidden" id="favDot">0</span></a>
            <a class="icon-btn" href="giris.html" aria-label="Hesabım">👤</a>
            <a class="icon-btn" href="sepet.html" aria-label="Sepet">🛍<span class="dot hidden" id="cartDot">0</span></a>
        </div>
    </div>
    <nav class="nav" id="mainNav"><div class="wrap">
        @php
            $categories=\App\Models\category::get();
            $Parentcategories=\App\Models\category::has('children')->get();
            $NonParentcategories=\App\Models\category::doesnthave('children')->wherenull('parent_id')->get();
         @endphp
            @foreach($Parentcategories as $c)
                    <div class="nav-item"><a class="nav-link" href="kategori.html?c=${c.slug}">
                            <span>{{$c->name}}</span>

                            <span class="nav-chevron">⌄</span></a><div class="submenu"><strong>{{$c->name}}</strong>
                               @foreach($categories as $b) @if($c->id==$b->parent_id) <a href="kategori.html?c=${c.slug}&s=${sub.slug}">{{$b->name}}</a> @endif @endforeach
                            <a class="all-link" href="kategori.html?c=${c.slug}">Tümünü görüntüle →</a></div></div>

            @endforeach
            @foreach($NonParentcategories as $n)
                <a class="link" href="kategori.html?indirim=1">{{$n->name}}</a>
            @endforeach

            <a class="sale" href="kategori.html?indirim=1">Kampanyalar</a>
        </div></nav>
</div>

@yield('content')

<div > <footer class="site-footer">
        <div class="wrap footer-grid">
            <div>
                <a class="logo" href="index.html" style="color:#fff"><span class="logo-mark">V</span><span>Voltra</span></a>
                <p class="muted" style="font-size:13px;max-width:280px">Bilgisayar, telefon ve teknoloji ürünlerinde distribütör garantili alışveriş.</p>
            </div>
            <div><h4>Kategoriler</h4>@foreach($Parentcategories as $c)<ul><li><a href="kategori.html?c=${c.slug}">{{$c->name}}</a></li></ul> @endforeach</div>
            <div><h4>Kurumsal</h4><ul>
                    <li><a href="kurumsal.html#hakkimizda">Hakkımızda</a></li>
                    <li><a href="kurumsal.html#iletisim">İletişim</a></li>
                    <li><a href="kurumsal.html#sss">Sıkça Sorulan Sorular</a></li>
                </ul></div>
            <div><h4>Yasal</h4><ul>
                    <li><a href="kurumsal.html#kvkk">KVKK Aydınlatma Metni</a></li>
                    <li><a href="kurumsal.html#mesafeli">Mesafeli Satış Sözleşmesi</a></li>
                    <li><a href="kurumsal.html#iade">İade ve Cayma Hakkı</a></li>
                    <li><a href="kurumsal.html#gizlilik">Gizlilik Politikası</a></li>
                </ul></div>
        </div>
        <div class="footer-bottom"><div class="wrap">
                <span>© ${new Date().getFullYear()} Voltra. Tüm hakları saklıdır.</span>
                <span>Kredi kartı • Havale/EFT • Kapıda ödeme</span>
            </div></div>
    </footer></div>

</body>
</html>
