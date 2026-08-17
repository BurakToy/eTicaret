/* Voltra Admin — ortak arayüz mantığı */

const asset = (p) => (!p ? "../img/favicon.svg" : /^(https?:|\.\.\/|data:)/.test(p) ? p : "../" + p);
const el = (html) => { const t = document.createElement("template"); t.innerHTML = html.trim(); return t.content.firstElementChild; };
const $ = (s, r = document) => r.querySelector(s);
const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));

function toast(msg, type = "success") {
  let host = $("#toastHost");
  if (!host) { host = el('<div id="toastHost" class="toast-host"></div>'); document.body.appendChild(host); }
  const t = el(`<div class="admin-toast ${type}">${msg}</div>`);
  host.appendChild(t);
  setTimeout(() => t.classList.add("show"), 10);
  setTimeout(() => { t.classList.remove("show"); setTimeout(() => t.remove(), 300); }, 2600);
}

const MENU = [
  { href: "index.html", icon: "▦", label: "Dashboard" },
  { href: "urunler.html", icon: "📦", label: "Ürünler" },
  { href: "kategoriler.html", icon: "🗂", label: "Kategoriler" },
  { href: "siparisler.html", icon: "🧾", label: "Siparişler" },
  { href: "stok.html", icon: "📊", label: "Stok" },
  { href: "musteriler.html", icon: "👥", label: "Müşteriler" },
];

function requireAuth() {
  if (localStorage.getItem("voltra:admin:session") !== "ok") {
    location.href = "giris.html?next=" + encodeURIComponent(location.pathname.split("/").pop() + location.search);
    return false;
  }
  return true;
}

function renderShell(active, title, actionsHtml = "") {
  if (!requireAuth()) return null;
  const db = DB.load();
  const lowStock = db.products.filter((p) => !p.deletedAt && productStock(p) <= (p.minStock ?? 5)).length;
  const pending = db.orders.filter((o) => ["beklemede", "onaylandi"].includes(o.status)).length;

  document.body.classList.add("admin-body");
  const shell = el(`
    <div class="admin-shell">
      <aside class="admin-side" id="adminSide">
        <a class="brand" href="index.html"><span class="brand-mark">V</span><span>Voltra <small>Admin</small></span></a>
        <nav class="side-nav">
          ${MENU.map((m) => `<a href="${m.href}" class="${m.href === active ? "active" : ""}"><span class="ic">${m.icon}</span>${m.label}
            ${m.href === "siparisler.html" && pending ? `<span class="badge text-bg-warning ms-auto">${pending}</span>` : ""}
            ${m.href === "stok.html" && lowStock ? `<span class="badge text-bg-danger ms-auto">${lowStock}</span>` : ""}</a>`).join("")}
        </nav>
        <div class="side-foot">
          <a href="../index.html" target="_blank" rel="noopener">↗ Mağazayı Gör</a>
          <button class="btn btn-sm btn-outline-light w-100 mt-2" id="resetDb">Demo Veriyi Sıfırla</button>
          <button class="btn btn-sm btn-outline-light w-100 mt-2" id="logoutBtn">Çıkış Yap</button>
        </div>
      </aside>
      <main class="admin-main">
        <header class="admin-top">
          <button class="btn btn-sm btn-outline-secondary d-lg-none" id="sideToggle">☰</button>
          <h1>${title}</h1>
          <div class="top-actions">${actionsHtml}</div>
        </header>
        <div class="admin-content" id="adminContent"></div>
      </main>
    </div>`);
  document.body.prepend(shell);
  $("#sideToggle").onclick = () => $("#adminSide").classList.toggle("open");
  $("#logoutBtn").onclick = () => { localStorage.removeItem("voltra:admin:session"); location.href = "giris.html"; };
  $("#resetDb").onclick = () => { if (confirm("Tüm demo veriler ilk haline döndürülsün mü?")) { DB.reset(); location.reload(); } };
  return $("#adminContent");
}

function statusBadge(s) {
  const st = ORDER_STATUSES[s];
  return `<span class="badge text-bg-${st?.color || "secondary"}">${st?.name || s}</span>`;
}
function productStatusBadge(s) {
  const map = { taslak: ["secondary", "Taslak"], yayinda: ["success", "Yayında"], pasif: ["dark", "Pasif/Arşiv"] };
  const [c, n] = map[s] || ["secondary", s];
  return `<span class="badge text-bg-${c}">${n}</span>`;
}
function stockBadge(p) {
  const s = productStock(p);
  if (s <= 0) return `<span class="badge text-bg-danger">Tükendi</span>`;
  if (s <= (p.criticalStock ?? 2)) return `<span class="badge text-bg-danger">${s} · Kritik</span>`;
  if (s <= (p.minStock ?? 5)) return `<span class="badge text-bg-warning">${s} · Düşük</span>`;
  return `<span class="badge text-bg-light border">${s}</span>`;
}

function addMovement(db, { productId, variantId, type, qty, note, user = "admin" }) {
  const p = db.products.find((x) => x.id === productId);
  if (!p) return;
  const v = p.variants.find((x) => x.id === variantId) || p.variants[0];
  const before = productStock(p);
  const dir = MOVEMENT_TYPES[type].dir;
  if (v) {
    if (dir === 0) v.stock = Math.max(0, Number(qty));
    else v.stock = Math.max(0, Number(v.stock || 0) + dir * Number(qty));
  } else {
    if (dir === 0) p.stock = Math.max(0, Number(qty));
    else p.stock = Math.max(0, Number(p.stock || 0) + dir * Number(qty));
  }
  p.stock = productStock(p);
  db.movements.unshift({
    id: uid("m"), date: new Date().toISOString().slice(0, 10), productId, variantId: v?.id || "",
    type, qty: Number(qty), before, after: productStock(p), user, note: note || "",
  });
}
