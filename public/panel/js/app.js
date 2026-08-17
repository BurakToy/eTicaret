/* Voltra statik şablon — ortak JS (vanilla, framework yok) */

/* ---------- Yardımcılar ---------- */
const TL = new Intl.NumberFormat("tr-TR", { style: "currency", currency: "TRY", maximumFractionDigits: 0 });
const money = (n) => TL.format(n);
const qs = (k) => new URLSearchParams(location.search).get(k) || "";
const el = (html) => { const t = document.createElement("template"); t.innerHTML = html.trim(); return t.content.firstElementChild; };

const Store = {
  get(key, def) { try { return JSON.parse(localStorage.getItem("voltra:" + key)) ?? def; } catch { return def; } },
  set(key, val) { localStorage.setItem("voltra:" + key, JSON.stringify(val)); document.dispatchEvent(new Event("store:change")); },
};
const getCart = () => Store.get("cart", []);
const getFavs = () => Store.get("favs", []);

function toast(msg) {
  let t = document.getElementById("toast");
  if (!t) { t = el('<div id="toast"></div>'); document.body.appendChild(t); }
  t.textContent = msg; t.classList.add("show");
  clearTimeout(t._h); t._h = setTimeout(() => t.classList.remove("show"), 2000);
}

function addToCart(id, qty = 1, variant = "") {
  const cart = getCart();
  const line = cart.find((l) => l.id === id && l.variant === variant);
  if (line) line.qty += qty; else cart.push({ id, qty, variant });
  Store.set("cart", cart);
  toast("Ürün sepete eklendi");
}
function toggleFav(id) {
  const favs = getFavs();
  const i = favs.indexOf(id);
  if (i > -1) favs.splice(i, 1); else favs.push(id);
  Store.set("favs", favs);
  toast(i > -1 ? "Favorilerden çıkarıldı" : "Favorilere eklendi");
}
const cartCount = () => getCart().reduce((s, l) => s + l.qty, 0);
const findProduct = (slug) => PRODUCTS.find((p) => p.slug === slug);

/* ---------- Header / Footer ---------- */
function renderChrome() {
  const header = document.getElementById("site-header");
  if (header) {
    header.innerHTML = `
      <div class="accent-bar"></div>
      <div class="topbar"><div class="wrap">
        <span>2.500 TL üzeri ücretsiz kargo</span>
        <span>Distribütör garantili • 14 gün iade</span>
      </div></div>
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
          ${CATEGORIES.map((c) => `<div class="nav-item"><a class="nav-link" href="kategori.html?c=${c.slug}">${c.name}<span class="nav-chevron">⌄</span></a><div class="submenu"><strong>${c.name}</strong>${c.subcategories.map((sub) => `<a href="kategori.html?c=${c.slug}&s=${sub.slug}">${sub.name}</a>`).join("")}<a class="all-link" href="kategori.html?c=${c.slug}">Tümünü görüntüle →</a></div></div>`).join("")}
          <a class="sale" href="kategori.html?indirim=1">Kampanyalar</a>
        </div></nav>
      </div>`;

    const nav = header.querySelector("#mainNav");
    header.querySelector("#menuBtn").onclick = () => nav.classList.toggle("open");

    const input = header.querySelector("#searchInput");
    const box = header.querySelector("#suggest");
    input.addEventListener("input", () => {
      const q = input.value.trim().toLocaleLowerCase("tr");
      if (q.length < 2) return box.classList.add("hidden");
      const hits = PRODUCTS.filter((p) => (p.name + " " + p.brand).toLocaleLowerCase("tr").includes(q)).slice(0, 5);
      const categoryHits = CATEGORIES.flatMap((c) => [{ name: c.name, href: `kategori.html?c=${c.slug}` }, ...c.subcategories.map((sub) => ({ name: `${c.name} / ${sub.name}`, href: `kategori.html?c=${c.slug}&s=${sub.slug}` }))]).filter((x) => x.name.toLocaleLowerCase("tr").includes(q)).slice(0, 3);
      if (!hits.length && !categoryHits.length) return box.classList.add("hidden");
      box.innerHTML = categoryHits.map((x) => `<a class="suggest-category" href="${x.href}"><span class="suggest-icon">▦</span><span>${x.name}</span></a>`).join("") + hits.map((p) => `<a href="urun.html?p=${p.slug}"><img src="${p.images[0]}" alt=""><span>${p.name}</span><span class="price">${money(p.price)}</span></a>`).join("");
      box.classList.remove("hidden");
    });
    input.addEventListener("keydown", (e) => {
      if (e.key === "Enter" && input.value.trim()) location.href = "arama.html?q=" + encodeURIComponent(input.value.trim());
    });
    document.addEventListener("click", (e) => { if (!e.target.closest(".search")) box.classList.add("hidden"); });
  }

  const footer = document.getElementById("site-footer");
  if (footer) {
    footer.innerHTML = `
      <footer class="site-footer">
        <div class="wrap footer-grid">
          <div>
            <a class="logo" href="index.html" style="color:#fff"><span class="logo-mark">V</span><span>Voltra</span></a>
            <p class="muted" style="font-size:13px;max-width:280px">Bilgisayar, telefon ve teknoloji ürünlerinde distribütör garantili alışveriş.</p>
          </div>
          <div><h4>Kategoriler</h4><ul>${CATEGORIES.map((c) => `<li><a href="kategori.html?c=${c.slug}">${c.name}</a></li>`).join("")}</ul></div>
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
      </footer>`;
  }
  syncBadges();
}

function syncBadges() {
  const c = document.getElementById("cartDot");
  const f = document.getElementById("favDot");
  if (c) { c.textContent = cartCount(); c.classList.toggle("hidden", cartCount() === 0); }
  if (f) { f.textContent = getFavs().length; f.classList.toggle("hidden", getFavs().length === 0); }
}
document.addEventListener("store:change", syncBadges);

/* ---------- Ürün kartı ---------- */
function productCard(p) {
  const fav = getFavs().includes(p.id);
  const off = p.oldPrice ? Math.round((1 - p.price / p.oldPrice) * 100) : 0;
  return `
  <article class="product-card">
    <a class="thumb" href="urun.html?p=${p.slug}">
      <img src="${p.images[0]}" alt="${p.name}" loading="lazy">
      <span class="flags">
        ${off ? `<span class="badge badge-danger">%${off} indirim</span>` : ""}
        ${p.tags.includes("yeni") ? `<span class="badge badge-accent">Yeni</span>` : ""}
        ${p.stock === 0 ? `<span class="badge badge-muted">Tükendi</span>` : ""}
      </span>
    </a>
    <button class="fav-btn ${fav ? "on" : ""}" data-fav="${p.id}" aria-label="Favorilere ekle">${fav ? "♥" : "♡"}</button>
    <div class="body">
      <span class="brand">${p.brand}</span>
      <a class="name" href="urun.html?p=${p.slug}">${p.name}</a>
      <span class="rating">★ ${p.rating.toFixed(1)} <span class="muted">(${p.reviews})</span></span>
      <div class="price-row">
        <span class="price">${money(p.price)}</span>
        ${p.oldPrice ? `<span class="price-old">${money(p.oldPrice)}</span>` : ""}
      </div>
      ${p.stock === 0
        ? `<span class="stock-out">Stokta yok</span>`
        : `<button class="btn btn-block" data-add="${p.id}">Sepete ekle</button>`}
    </div>
  </article>`;
}

function bindCards(root = document) {
  root.querySelectorAll("[data-add]").forEach((b) => (b.onclick = () => addToCart(b.dataset.add)));
  root.querySelectorAll("[data-fav]").forEach((b) => (b.onclick = () => { toggleFav(b.dataset.fav); b.classList.toggle("on"); b.textContent = b.classList.contains("on") ? "♥" : "♡"; }));
}

/* ---------- Listeleme (kategori / arama / favoriler) ---------- */
function renderList({ mount, items, withFilters = true }) {
  const wrap = document.querySelector(mount);
  if (!wrap) return;
  let source = items;
  const state = { brands: new Set(), max: Math.max(...source.map((p) => p.price), 1000), inStock: false, sort: "onerilen" };

  const brands = [...new Set(source.map((p) => p.brand))].sort();
  wrap.innerHTML = `
    <div class="wrap list-layout">
      ${withFilters ? `<aside class="filters">
        <div class="filter-group"><h4>Marka</h4>
          ${brands.map((b) => `<label class="check"><input type="checkbox" value="${b}" data-brand> ${b}</label>`).join("")}
        </div>
        <div class="filter-group"><h4>Maksimum fiyat</h4>
          <input class="range" type="range" min="500" max="${state.max}" value="${state.max}" step="500" id="priceRange">
          <div class="muted" style="font-size:13px" id="priceOut">${money(state.max)}</div>
        </div>
        <div class="filter-group">
          <label class="check"><input type="checkbox" id="inStock"> Sadece stoktakiler</label>
        </div>
        <div class="filter-group"><button class="btn btn-outline btn-block" id="clearFilters">Filtreleri temizle</button></div>
      </aside>` : "<div></div>"}
      <section>
        <div class="toolbar">
          <span class="count" id="listCount"></span>
          <select id="sortSel">
            <option value="onerilen">Önerilen</option>
            <option value="artan">Fiyat: Artan</option>
            <option value="azalan">Fiyat: Azalan</option>
            <option value="puan">Puana göre</option>
          </select>
        </div>
        <div class="grid-products" id="listGrid"></div>
        <div class="empty hidden" id="listEmpty">Aradığınız kriterlere uygun ürün bulunamadı.</div>
      </section>
    </div>`;

  const grid = wrap.querySelector("#listGrid");
  const empty = wrap.querySelector("#listEmpty");
  const count = wrap.querySelector("#listCount");

  function paint() {
    let out = source.filter((p) =>
      (!state.brands.size || state.brands.has(p.brand)) &&
      p.price <= state.max &&
      (!state.inStock || p.stock > 0));
    if (state.sort === "artan") out.sort((a, b) => a.price - b.price);
    if (state.sort === "azalan") out.sort((a, b) => b.price - a.price);
    if (state.sort === "puan") out.sort((a, b) => b.rating - a.rating);
    grid.innerHTML = out.map(productCard).join("");
    count.textContent = `${out.length} ürün listeleniyor`;
    empty.classList.toggle("hidden", out.length > 0);
    bindCards(grid);
  }

  wrap.querySelectorAll("[data-brand]").forEach((cb) => (cb.onchange = () => { cb.checked ? state.brands.add(cb.value) : state.brands.delete(cb.value); paint(); }));
  const range = wrap.querySelector("#priceRange");
  if (range) range.oninput = () => { state.max = +range.value; wrap.querySelector("#priceOut").textContent = money(state.max); paint(); };
  const stock = wrap.querySelector("#inStock");
  if (stock) stock.onchange = () => { state.inStock = stock.checked; paint(); };
  wrap.querySelector("#sortSel").onchange = (e) => { state.sort = e.target.value; paint(); };
  const clear = wrap.querySelector("#clearFilters");
  if (clear) clear.onclick = () => {
    state.brands.clear(); state.inStock = false; state.max = Math.max(...source.map((p) => p.price), 1000);
    wrap.querySelectorAll("[data-brand]").forEach((c) => (c.checked = false));
    if (stock) stock.checked = false;
    if (range) { range.value = state.max; wrap.querySelector("#priceOut").textContent = money(state.max); }
    paint();
  };
  paint();
}

document.addEventListener("DOMContentLoaded", renderChrome);
