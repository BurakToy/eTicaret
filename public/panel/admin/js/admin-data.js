/* Voltra Admin — veri katmanı (localStorage tabanlı, backend gerektirmez)
   js/data.js (CATEGORIES, PRODUCTS) bu dosyadan ÖNCE yüklenmelidir. */

const DB_KEY = "voltra:admin:v1";

const TR_UP = (s) => (s || "").toLocaleUpperCase("tr");
const slugify = (s) =>
  (s || "")
    .toLocaleLowerCase("tr")
    .replace(/ı/g, "i").replace(/ş/g, "s").replace(/ğ/g, "g")
    .replace(/ü/g, "u").replace(/ö/g, "o").replace(/ç/g, "c")
    .replace(/[^a-z0-9]+/g, "-").replace(/^-|-$/g, "");

const normalizeTR = (s) =>
  (s || "").toLocaleLowerCase("tr")
    .replace(/ı/g, "i").replace(/ş/g, "s").replace(/ğ/g, "g")
    .replace(/ü/g, "u").replace(/ö/g, "o").replace(/ç/g, "c");

const TAGS = [
  { id: "yeni", name: "Yeni Ürün" },
  { id: "cok-satan", name: "Çok Satan" },
  { id: "one-cikan", name: "Öne Çıkan" },
  { id: "indirim", name: "Kampanyalı" },
];

const ORDER_STATUSES = {
  beklemede: { name: "Beklemede", next: ["onaylandi", "iptal"], color: "warning" },
  onaylandi: { name: "Onaylandı", next: ["hazirlaniyor", "iptal"], color: "info" },
  hazirlaniyor: { name: "Hazırlanıyor", next: ["kargoda", "iptal"], color: "primary" },
  kargoda: { name: "Kargoya Verildi", next: ["tamamlandi", "iade-talebi"], color: "secondary" },
  tamamlandi: { name: "Tamamlandı", next: ["iade-talebi"], color: "success" },
  "iade-talebi": { name: "İade Talebi", next: ["iptal", "tamamlandi"], color: "danger" },
  iptal: { name: "İptal", next: [], color: "dark" },
};

const MOVEMENT_TYPES = {
  giris: { name: "Stok Girişi", dir: +1 },
  cikis: { name: "Stok Çıkışı (Manuel)", dir: -1 },
  rezervasyon: { name: "Sipariş Rezervasyonu", dir: -1 },
  "iptal-iade": { name: "Sipariş İptali (İade)", dir: +1 },
  sayim: { name: "Sayım Düzeltmesi", dir: 0 },
};

/* ---------- Tohum veri ---------- */
function seedCategories() {
  const rows = [];
  let order = 1;
  CATEGORIES.forEach((c) => {
    rows.push({
      id: c.slug, name: c.name, parent: null, image: `img/${c.slug}.jpg`,
      order: order++, seoTitle: `${c.name} | Voltra`, seoDesc: c.desc, slug: c.slug, active: true,
    });
    let so = 1;
    (c.subcategories || []).forEach((s) => {
      rows.push({
        id: `${c.slug}:${s.slug}`, name: s.name, parent: c.slug, image: "",
        order: so++, seoTitle: `${s.name} | Voltra`, seoDesc: `${c.name} kategorisinde ${s.name.toLocaleLowerCase("tr")} ürünleri`, slug: s.slug, active: true,
      });
    });
  });
  return rows;
}

function seedProducts() {
  return PRODUCTS.map((p, i) => {
    const base = TR_UP(p.brand).slice(0, 3) + "-" + String(1000 + i);
    const variants = (p.colors || ["Standart"]).map((c, vi) => ({
      id: `${p.id}-v${vi + 1}`,
      color: c,
      size: "Tek Beden",
      sku: `${base}-${slugify(c).toUpperCase().slice(0, 3)}`,
      stock: Math.max(0, Math.round((p.stock || 0) / (p.colors?.length || 1))),
      price: p.price,
      salePrice: p.oldPrice ? p.price : null,
      image: p.images?.[vi] || p.images?.[0] || "",
    }));
    return {
      id: p.id,
      name: p.name,
      sku: base,
      barcode: "868" + String(1000000 + i * 137).padStart(10, "0"),
      category: p.category,
      subcategory: p.subcategory || "",
      brand: p.brand,
      tags: p.tags || [],
      shortDesc: (p.desc || "").slice(0, 120),
      desc: `<p>${p.desc || ""}</p><ul>${Object.entries(p.specs || {}).map(([k, v]) => `<li><b>${k}:</b> ${v}</li>`).join("")}</ul>`,
      seoTitle: `${p.name} | Voltra`,
      seoDesc: p.desc || "",
      slug: p.slug,
      metaKeywords: [p.brand, p.category, p.subcategory].filter(Boolean).join(", "),
      cover: p.images?.[0] || "",
      gallery: p.images || [],
      price: p.price,
      salePrice: p.oldPrice ? p.price : null,
      listPrice: p.oldPrice || p.price,
      vat: 20,
      status: "yayinda",
      minStock: 5,
      criticalStock: 2,
      stock: p.stock || 0,
      variants,
      deletedAt: null,
      createdAt: "2026-0" + ((i % 8) + 1) + "-12",
    };
  });
}

function seedCustomers() {
  const names = [
    ["Elif Yılmaz", "elif.yilmaz@example.com", "0532 111 22 33"],
    ["Mert Demir", "mert.demir@example.com", "0533 222 33 44"],
    ["Zeynep Kaya", "zeynep.kaya@example.com", "0534 333 44 55"],
    ["Burak Toy", "burak.toy@example.com", "0535 444 55 66"],
    ["Ayşe Şahin", "ayse.sahin@example.com", "0536 555 66 77"],
  ];
  return names.map((n, i) => ({
    id: "c" + (i + 1), name: n[0], email: n[1], phone: n[2],
    createdAt: `2026-0${(i % 7) + 1}-1${i}`, lastLogin: "2026-08-1" + (i + 1), active: true,
    addresses: [{ title: "Ev", city: ["İstanbul", "Ankara", "İzmir", "Bursa", "Antalya"][i], district: ["Kadıköy", "Çankaya", "Karşıyaka", "Nilüfer", "Muratpaşa"][i], line: "Örnek Mah. " + (i + 3) + ". Sokak No: " + (i + 5) }],
  }));
}

function seedOrders(products, customers) {
  const mk = (i, status, days) => {
    const p1 = products[i % products.length];
    const p2 = products[(i + 3) % products.length];
    const items = [
      { productId: p1.id, name: p1.name, variant: p1.variants[0]?.color || "-", qty: 1, price: p1.price },
      { productId: p2.id, name: p2.name, variant: p2.variants[0]?.color || "-", qty: 2, price: p2.price },
    ];
    const total = items.reduce((s, it) => s + it.price * it.qty, 0);
    const c = customers[i % customers.length];
    const d = `2026-08-${String(20 - days).padStart(2, "0")}`;
    return {
      id: `SP-2026080${(i % 9) + 1}-00${100 + i}`,
      date: d, status, customerId: c.id, customerName: c.name, customerEmail: c.email, customerPhone: c.phone,
      payment: i % 2 ? "Havale/EFT" : "Kapıda Ödeme",
      address: `${c.addresses[0].line}, ${c.addresses[0].district} / ${c.addresses[0].city}`,
      billingAddress: "", note: i % 3 === 0 ? "Kapıcıya bırakılabilir." : "",
      adminNotes: [], tracking: status === "kargoda" || status === "tamamlandi" ? "TR" + (884512396 + i) : "",
      items, subtotal: total, vat: Math.round(total * 0.2), discount: 0, total,
      history: [{ status: "beklemede", at: d + " 10:12", by: "sistem" }],
    };
  };
  const statuses = ["beklemede", "onaylandi", "hazirlaniyor", "kargoda", "tamamlandi", "beklemede", "iptal", "tamamlandi"];
  return statuses.map((s, i) => {
    const o = mk(i, s, i);
    if (s !== "beklemede") o.history.push({ status: s, at: o.date + " 14:30", by: "admin" });
    return o;
  });
}

function seedMovements(products) {
  const out = [];
  products.slice(0, 8).forEach((p, i) => {
    out.push({
      id: "m" + (i + 1), date: `2026-08-0${(i % 9) + 1}`, productId: p.id, variantId: p.variants[0]?.id || "",
      type: "giris", qty: 20, before: Math.max(0, p.stock - 20), after: p.stock, user: "admin", note: "Tedarikçi mal kabulü",
    });
  });
  return out;
}

/* ---------- DB ---------- */
function freshDB() {
  const products = seedProducts();
  const customers = seedCustomers();
  return {
    products,
    categories: seedCategories(),
    orders: seedOrders(products, customers),
    customers,
    movements: seedMovements(products),
    session: null,
  };
}

const DB = {
  load() {
    try {
      const raw = JSON.parse(localStorage.getItem(DB_KEY));
      if (raw && raw.products) return raw;
    } catch { /* yoksayılır */ }
    const db = freshDB();
    localStorage.setItem(DB_KEY, JSON.stringify(db));
    return db;
  },
  save(db) {
    localStorage.setItem(DB_KEY, JSON.stringify(db));
    // Vitrin tarafı yalnızca "yayında" ürünleri görsün diye köprü
    localStorage.setItem("voltra:published", JSON.stringify(db.products.filter((p) => p.status === "yayinda" && !p.deletedAt).map((p) => p.id)));
  },
  reset() { const db = freshDB(); DB.save(db); return db; },
};

/* ---------- Yardımcılar ---------- */
const productStock = (p) => (p.variants?.length ? p.variants.reduce((s, v) => s + Number(v.stock || 0), 0) : Number(p.stock || 0));
const catName = (db, slug) => db.categories.find((c) => c.id === slug)?.name || slug || "-";
const subName = (db, cat, sub) => db.categories.find((c) => c.id === `${cat}:${sub}`)?.name || sub || "-";
const money = (n) => new Intl.NumberFormat("tr-TR", { style: "currency", currency: "TRY", maximumFractionDigits: 0 }).format(Number(n || 0));
const uid = (pre) => pre + Math.random().toString(36).slice(2, 8);
