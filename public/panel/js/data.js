/* Örnek katalog verisi — kendi verinizle değiştirin */
const CATEGORIES = [
  { slug: "bilgisayar", name: "Bilgisayar", icon: "💻", desc: "Dizüstü, masaüstü ve oyuncu bilgisayarları", subcategories: [
    { slug: "dizustu", name: "Dizüstü Bilgisayar" }, { slug: "oyuncu", name: "Oyuncu Bilgisayarı" }, { slug: "profesyonel", name: "Profesyonel İş İstasyonu" }
  ] },
  { slug: "telefon", name: "Telefon", icon: "📱", desc: "Akıllı ve katlanabilir telefonlar", subcategories: [
    { slug: "akilli-telefon", name: "Akıllı Telefon" }, { slug: "amiral-gemisi", name: "Amiral Gemisi" }, { slug: "uygun-fiyatli", name: "Uygun Fiyatlı Telefon" }
  ] },
  { slug: "tablet", name: "Tablet", icon: "📒", desc: "Tablet ve kalem", subcategories: [
    { slug: "standart-tablet", name: "Tablet" }, { slug: "kompakt-tablet", name: "Kompakt Tablet" }
  ] },
  { slug: "ses", name: "Ses", icon: "🎧", desc: "Kulaklık ve hoparlör", subcategories: [
    { slug: "kulaklik", name: "Kulaklık" }, { slug: "hoparlor", name: "Hoparlör" }
  ] },
  { slug: "monitor", name: "Monitör", icon: "🖥️", desc: "Oyuncu ve ofis monitörleri", subcategories: [
    { slug: "ofis-monitoru", name: "Ofis Monitörü" }, { slug: "oyuncu-monitoru", name: "Oyuncu Monitörü" }
  ] },
  { slug: "aksesuar", name: "Aksesuar", icon: "⌚", desc: "Şarj, kılıf ve akıllı saat", subcategories: [
    { slug: "sarj", name: "Şarj Ürünleri" }, { slug: "akilli-saat", name: "Akıllı Saat" }
  ] },
];

/* Görseller img/ klasöründe yereldir. Kendi fotoğraflarınızı aynı isimlerle değiştirebilirsiniz. */
const img = (name) => `img/${name}.jpg`;

const PRODUCTS = [
  { id: "p1", subcategory: "dizustu", slug: "novabook-air-14", name: "NovaBook Air 14 M3 16GB 512GB", brand: "NovaBook", category: "bilgisayar", price: 42999, oldPrice: 47999, rating: 4.7, reviews: 128, stock: 12, colors: ["Uzay Grisi", "Gümüş"], tags: ["indirim", "cok-satan"], images: [img("bilgisayar"), img("monitor"), img("aksesuar")], specs: { İşlemci: "M3 8 çekirdek", RAM: "16 GB", Depolama: "512 GB SSD", Ekran: "14\" Retina", Garanti: "24 ay" }, desc: "Fansız tasarım, 18 saat pil ömrü ve distribütör garantisiyle ultra taşınabilir dizüstü." },
  { id: "p2", subcategory: "amiral-gemisi", slug: "helio-x7-pro", name: "Helio X7 Pro 256GB", brand: "Helio", category: "telefon", price: 54999, oldPrice: null, rating: 4.8, reviews: 342, stock: 7, colors: ["Titanyum", "Siyah", "Mavi"], tags: ["yeni"], images: [img("telefon"), img("saat"), img("aksesuar")], specs: { Ekran: "6.7\" LTPO AMOLED", Kamera: "200 MP", Batarya: "5000 mAh", Gövde: "Titanyum", Garanti: "24 ay" }, desc: "200MP kamera, LTPO ekran ve titanyum gövdeyle amiral gemisi deneyimi." },
  { id: "p3", subcategory: "standart-tablet", slug: "aura-pad-11", name: "AuraPad 11 Wi-Fi 128GB", brand: "Aura", category: "tablet", price: 18499, oldPrice: 20999, rating: 4.5, reviews: 86, stock: 20, colors: ["Gri", "Yeşil"], tags: ["indirim"], images: [img("tablet"), img("aksesuar"), img("monitor")], specs: { Ekran: "11\" IPS 120Hz", Depolama: "128 GB", Kalem: "Destekli", Garanti: "24 ay" }, desc: "Not almak ve içerik tüketmek için ince, hafif ve güçlü tablet." },
  { id: "p4", subcategory: "kulaklik", slug: "sonic-buds-pro", name: "Sonic Buds Pro ANC", brand: "Sonic", category: "ses", price: 4299, oldPrice: 5399, rating: 4.6, reviews: 511, stock: 40, colors: ["Beyaz", "Siyah"], tags: ["indirim", "cok-satan"], images: [img("ses"), img("hoparlor"), img("aksesuar")], specs: { "Gürültü Engelleme": "Adaptif ANC", Pil: "40 saat", Bağlantı: "Bluetooth 5.4", Garanti: "24 ay" }, desc: "Adaptif gürültü engelleme ve 40 saat toplam pil ömrü." },
  { id: "p5", subcategory: "ofis-monitoru", slug: "vision-27-4k", name: "Vision 27\" 4K IPS Monitör", brand: "Vision", category: "monitor", price: 13999, oldPrice: null, rating: 4.4, reviews: 63, stock: 0, colors: ["Siyah"], tags: [], images: [img("monitor"), img("bilgisayar"), img("aksesuar")], specs: { Çözünürlük: "3840x2160", Panel: "IPS 60Hz", Bağlantı: "HDMI 2.1 / USB-C 90W", Garanti: "36 ay" }, desc: "USB-C ile tek kabloda görüntü, veri ve 90W şarj." },
  { id: "p6", subcategory: "sarj", slug: "volt-charge-65w", name: "VoltCharge 65W GaN Şarj Adaptörü", brand: "Voltra", category: "aksesuar", price: 899, oldPrice: 1199, rating: 4.9, reviews: 780, stock: 150, colors: ["Beyaz"], tags: ["indirim", "cok-satan"], images: [img("aksesuar"), img("saat"), img("telefon")], specs: { Güç: "65W", Port: "2x USB-C, 1x USB-A", Teknoloji: "GaN III", Garanti: "24 ay" }, desc: "Üç cihazı aynı anda hızlı şarj eden kompakt GaN adaptör." },
  { id: "p7", subcategory: "profesyonel", slug: "novabook-pro-16", name: "NovaBook Pro 16 32GB 1TB", brand: "NovaBook", category: "bilgisayar", price: 89999, oldPrice: null, rating: 4.9, reviews: 74, stock: 5, colors: ["Uzay Siyahı"], tags: ["yeni"], images: [img("bilgisayar"), img("monitor"), img("aksesuar")], specs: { İşlemci: "M3 Max", RAM: "32 GB", Depolama: "1 TB SSD", Ekran: "16\" XDR", Garanti: "24 ay" }, desc: "Video kurgu ve 3B iş akışları için profesyonel performans." },
  { id: "p8", subcategory: "uygun-fiyatli", slug: "helio-lite-5g", name: "Helio Lite 5G 128GB", brand: "Helio", category: "telefon", price: 15999, oldPrice: 17999, rating: 4.2, reviews: 219, stock: 33, colors: ["Mavi", "Siyah"], tags: ["indirim"], images: [img("telefon"), img("saat"), img("aksesuar")], specs: { Ekran: "6.5\" AMOLED", Kamera: "50 MP", Batarya: "5200 mAh", Garanti: "24 ay" }, desc: "Uygun fiyata güçlü batarya ve 5G bağlantı." },
  { id: "p9", subcategory: "hoparlor", slug: "sonic-wave-speaker", name: "SonicWave Taşınabilir Hoparlör", brand: "Sonic", category: "ses", price: 2799, oldPrice: null, rating: 4.3, reviews: 154, stock: 18, colors: ["Antrasit", "Kum"], tags: [], images: [img("hoparlor"), img("ses"), img("aksesuar")], specs: { Güç: "30W", Su: "IP67", Pil: "24 saat", Garanti: "24 ay" }, desc: "IP67 suya dayanıklı gövde ve 24 saat çalma süresi." },
  { id: "p10", subcategory: "akilli-saat", slug: "aura-watch-s2", name: "Aura Watch S2 GPS", brand: "Aura", category: "aksesuar", price: 6499, oldPrice: 7499, rating: 4.5, reviews: 302, stock: 24, colors: ["Siyah", "Bej"], tags: ["indirim"], images: [img("saat"), img("aksesuar"), img("telefon")], specs: { Ekran: "1.9\" AMOLED", Sensör: "SpO2, EKG", Pil: "7 gün", Garanti: "24 ay" }, desc: "Sağlık takibi ve 7 güne varan pil ömrüyle akıllı saat." },
  { id: "p11", subcategory: "oyuncu-monitoru", slug: "vision-34-ultrawide", name: "Vision 34\" UltraWide 144Hz", brand: "Vision", category: "monitor", price: 24999, oldPrice: 27999, rating: 4.7, reviews: 41, stock: 9, colors: ["Siyah"], tags: ["indirim"], images: [img("monitor"), img("bilgisayar"), img("aksesuar")], specs: { Çözünürlük: "3440x1440", Yenileme: "144 Hz", Panel: "VA kavisli", Garanti: "36 ay" }, desc: "Oyun ve çoklu görev için geniş kavisli ekran." },
  { id: "p12", subcategory: "kompakt-tablet", slug: "aura-pad-mini", name: "AuraPad Mini 8.3\" 64GB", brand: "Aura", category: "tablet", price: 11499, oldPrice: null, rating: 4.1, reviews: 57, stock: 15, colors: ["Gri"], tags: [], images: [img("tablet"), img("aksesuar"), img("monitor")], specs: { Ekran: "8.3\" IPS", Depolama: "64 GB", Ağırlık: "297 g", Garanti: "24 ay" }, desc: "Tek elle kullanılabilen kompakt tablet." },
];
