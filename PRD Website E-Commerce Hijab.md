# Product Requirement Document (PRD)

## Website E-Commerce Hijab — \[Nama Brand Hijab\]

**Versi:** 1.0 · **Status:** Draft untuk development · **Konsep:** Pink Feminine + Floral Elegant **Positioning:** *"Luxury feminine hijab boutique meets modern Indonesian e-commerce."*

---

## Daftar Isi

1. Product Vision · 2. Business Objective · 3. User Persona · 4. Target Market · 5. User Journey · 6. User Flow · 7. Feature Requirements · 8. Functional Requirements · 9. Non-Functional Requirements · 10. Information Architecture · 11. Page Structure · 12. UI/UX Guidelines · 13. Design System · 14. Color Palette · 15. Typography · 16. Component System · 17. Database Schema · 18. Role & Permission · 19. Recommendation System · 20. Admin Dashboard · 21. E-commerce Workflow · 22. Security · 23. SEO · 24. Performance · 25. Analytics & KPI · 26. Roadmap

---

## 1. Product Vision

**Vision:** Menjadi destinasi online hijab premium yang terasa seperti butik: lembut, elegan, dan terpercaya, dengan pengalaman belanja semudah marketplace modern.

**Misi**

- Menyajikan koleksi hijab dengan visual yang memikat dan konsisten dengan identitas brand.
- Membuat pencarian, pemilihan varian, dan pembayaran cepat dan tanpa friksi, terutama di smartphone.
- Memberi owner kendali penuh atas produk, stok, pesanan, promosi, dan insight penjualan dalam satu dashboard.

**Prinsip produk:** (1) Mobile-first, (2) Visual produk adalah fokus utama, bunga hanya pendukung, (3) Checkout sesingkat mungkin, (4) Urgensi yang elegan, bukan agresif, (5) Berbeda dari marketplace generik.

## 2. Business Objective

| # | Objective | Indikator keberhasilan (3–6 bulan pertama, target awal) |
| --- | --- | --- |
| 1 | Menjual hijab secara online | Order rutin harian, revenue bulanan tumbuh bertahap |
| 2 | Membangun brand feminin & premium | Direct/organic traffic naik, repeat customer ≥ 25% |
| 3 | Mempermudah pencarian & pembelian | Conversion rate ≥ 2%, checkout completion ≥ 60% |
| 4 | Efisiensi operasional owner | Update stok & proses order \< 5 menit per order |
| 5 | Meningkatkan nilai transaksi | AOV naik lewat bundle, voucher minimum belanja, rekomendasi |
| 6 | Mengurangi cart abandonment | Abandonment ≤ 70% (benchmark e-commerce umum 70–80%) |

*Angka adalah target awal yang disarankan; sesuaikan dengan baseline bisnis Anda.*

## 3. User Persona

**Persona 1: Alya, 20 tahun, Mahasiswa**

- Aktif di Instagram/TikTok, budget terbatas, suka promo dan voucher.
- Kebutuhan: hijab harian, harga terjangkau, tampilan estetik, ongkir murah.
- Pain point: sulit menilai warna asli, ragu soal bahan.

**Persona 2: Nadia, 27 tahun, Pekerja Muda**

- Butuh hijab rapi untuk kantor, jarang sempat browsing lama.
- Kebutuhan: filter cepat (warna, bahan), checkout singkat, pengiriman cepat.
- Pain point: stok warna cepat habis, proses retur ribet.

**Persona 3: Rina, 31 tahun, Ibu Muda**

- Butuh hijab praktis (instant), nyaman, mudah dirawat.
- Kebutuhan: info bahan & perawatan jelas, review dengan foto, COD/transfer mudah.
- Pain point: waktu terbatas, takut salah ukuran/bahan.

**Persona 4: Owner/Admin (Anda)**

- Mengelola bisnis dengan tim kecil, sering via HP dan laptop.
- Kebutuhan: input produk cepat, stok akurat, laporan jelas, kontrol promo.
- Pain point: stok tidak sinkron, pencatatan manual.

## 4. Target Market

- **Primer:** Perempuan 17–35 tahun, Indonesia, pengguna smartphone aktif, belanja fashion online.
- **Sekunder:** Mahasiswa, pekerja muda, ibu muda, pecinta modest fashion.
- **Geografi awal:** Pulau Jawa dan kota besar, lalu seluruh Indonesia lewat ekspedisi nasional.
- **Perilaku:** Terpengaruh Instagram/TikTok, sensitif promo, mengutamakan review dan foto asli, terbiasa dengan QRIS, e-wallet, dan transfer bank.
- **Diferensiasi:** Estetika butik premium, kurasi koleksi, storytelling brand, bukan katalog massal.

## 5. User Journey (Customer)

| Tahap | Aksi | Emosi/Kebutuhan | Peluang produk |
| --- | --- | --- | --- |
| Awareness | Melihat IG/TikTok, masuk ke homepage | Tertarik visual | Hero kuat, Instagram gallery |
| Consideration | Browse kategori, filter, buka detail | Ingin yakin kualitas | Foto multi-angle, zoom, review foto, info bahan |
| Decision | Pilih varian, add to cart | Takut kehabisan | "Only 5 left", stok real-time |
| Purchase | Cart → checkout → bayar | Ingin cepat & aman | Checkout 1 halaman, metode bayar lengkap |
| Post-purchase | Tracking, terima barang | Cemas menunggu | Timeline status, notifikasi |
| Loyalty | Review, repeat order | Puas dan dihargai | Voucher repeat, rekomendasi personal |

## 6. User Flow

**Customer:** `Homepage → Browse Product → Product Detail → Add to Cart → Cart → Checkout → Payment → Order Confirmation → Shipping → Delivered → Review`

Alur alternatif: Search/Autocomplete → Product Detail · Wishlist → Cart · Buy Now → Checkout (skip cart) · Guest checkout atau login/register saat checkout · Voucher diterapkan di Cart/Checkout.

**Admin:** `Admin Login → Dashboard → Manage Product → Manage Stock → Manage Order → Update Order → Sales Report`

Alur alternatif: Notifikasi low stock → Manage Stock · Pending payment → Confirm Payment → Processing · Banner/Voucher baru → Publish.

## 7. Feature Requirements (Ringkasan)

| Modul | Fitur | Prioritas |
| --- | --- | --- |
| Katalog | Listing, filter, sorting, search + autocomplete, kategori | MVP |
| Produk | Detail, varian, galeri + zoom, review + foto, related products | MVP |
| Transaksi | Cart, checkout, shipping, payment, voucher, order tracking | MVP |
| Akun | Register/login, profil, alamat, riwayat order, wishlist | MVP |
| Promosi | Voucher, diskon, banner, flash sale, bundle, free shipping | MVP (flash sale & bundle: Fase 2) |
| Konten | About, Contact, FAQ, T&C, Privacy, Promo/Sale | MVP |
| Admin | Dashboard, produk, stok, order, customer, voucher, banner, review, laporan, settings | MVP |
| Rekomendasi | You May Also Like (rule-based) | MVP |
| Notifikasi | Email/WhatsApp status order, low stock alert | MVP (WhatsApp: Fase 2) |
| Analytics | KPI, funnel, abandonment | MVP dasar, lanjut Fase 2 |

## 8. Functional Requirements (Detail per Fitur)

Format: **Tujuan · User · Input · Output · Interaksi · Business Logic · Acceptance Criteria (AC)**

### F-01 Homepage

- **Tujuan:** Memperkenalkan brand dan mengarahkan ke pembelian.
- **User:** Customer, guest.
- **Input:** Konten dari CMS (banner, produk featured/best seller/new).
- **Output:** Hero, Featured Categories, Best Seller, New Arrivals, Promo Banner, Why Choose Us, Testimonials, Instagram Gallery, Newsletter.
- **Interaksi:** Klik CTA (Shop Now/Explore Collection), quick add to cart, wishlist toggle, subscribe newsletter.
- **Logic:** Best Seller = flag admin atau top penjualan 30 hari; New Arrivals = produk terbaru (maks 8–12); banner tampil sesuai jadwal aktif.
- **AC:** LCP \< 2,5 detik pada 4G; semua section tampil responsif; CTA hero menuju /shop; floral tidak menutupi produk/teks.

### F-02 Product Listing (Shop)

- **Tujuan:** Membantu customer menemukan produk cepat.
- **User:** Customer, guest.
- **Input:** Filter (kategori, harga, warna, bahan, ukuran, rating, ketersediaan), sorting, halaman.
- **Output:** Grid produk dengan gambar, nama, harga, harga diskon, % diskon, rating, jumlah review, status stok, wishlist, add to cart.
- **Interaksi:** Filter via drawer di mobile / sidebar di desktop; perubahan filter memperbarui URL (shareable); infinite scroll atau pagination.
- **Logic:** Sorting: Terbaru (created_at), Terlaris (total_sold), Harga termurah/tertinggi (harga efektif setelah diskon), Rating tertinggi (rata-rata, tie-break jumlah review). Produk stok 0 tetap tampil dengan label "Habis".
- **AC:** Kombinasi filter bekerja bersamaan; hasil \< 1 detik untuk 1.000 produk; state kosong menampilkan empty state berfloral + saran kategori.

### F-03 Search & Autocomplete

- **Tujuan:** Pencarian cepat berbasis kata kunci.
- **Input:** Teks (nama, kategori, bahan, warna, keyword).
- **Output:** Saran autocomplete (mis. "Hijab" → Hijab Voal, Hijab Premium, Hijab Pashmina, Best Seller Hijab) dan halaman hasil.
- **Logic:** Autocomplete muncul setelah ≥ 2 karakter, debounce 250 ms, maks 8 saran; toleransi typo ringan; pencarian kosong ditampilkan produk populer.
- **AC:** Saran \< 300 ms; hasil dapat difilter/diurutkan; query disimpan untuk analytics (istilah tanpa hasil).

### F-04 Product Detail

- **Tujuan:** Memberi keyakinan untuk membeli.
- **Input:** Pilihan varian (warna/ukuran), qty.
- **Output:** Galeri multi-gambar + zoom, nama, harga, diskon, rating, jumlah review, deskripsi, material, ukuran, warna, detail produk, cara perawatan, estimasi pengiriman, info stok, Add to Cart, Buy Now, Wishlist, Reviews, Related Products.
- **Interaksi:** Ganti varian memperbarui gambar, harga, dan stok; zoom hover (desktop) / pinch (mobile).
- **Logic:** Qty maksimum = stok varian; stok ≤ 5 menampilkan "Only X left"; varian habis dinonaktifkan; Buy Now melewati cart.
- **AC:** Tidak bisa add varian belum dipilih (pesan jelas); harga selalu sinkron dengan varian; structured data Product tersedia.

### F-05 Reviews & Rating

- **Tujuan:** Social proof.
- **User:** Customer yang sudah membeli (verified purchase).
- **Input:** Rating 1–5, teks, foto (maks 3, maks 3 MB/foto).
- **Output:** Daftar review, rata-rata rating, distribusi bintang, badge "Verified Purchase".
- **Logic:** Review hanya setelah status Delivered/Completed; satu review per order item; moderasi admin (approve/hide) sebelum tampil.
- **AC:** Foto dikompres otomatis; review tersortir terbaru/dengan foto; rata-rata rating diperbarui setelah approval.

### F-06 Wishlist

- **Tujuan:** Menyimpan produk incaran.
- **Input:** Toggle ikon hati.
- **Output:** Halaman wishlist, pindah ke cart.
- **Logic:** Guest diminta login saat menyimpan (atau simpan lokal lalu sinkron setelah login); data wishlist menjadi customer insight admin.
- **AC:** Toggle instan (optimistic UI); wishlist persisten antar perangkat setelah login.

### F-07 Shopping Cart

- **Tujuan:** Mengelola item sebelum bayar.
- **Input:** Qty, hapus item, kode voucher.
- **Output:** Thumbnail, nama, varian, harga, qty selector, subtotal, diskon, ongkir, total, "You may also like", CTA **Proceed to Checkout**.
- **Logic:** Cart guest disimpan di session/cookie dan digabung ke akun saat login; validasi stok setiap perubahan; harga diverifikasi ulang di server.
- **AC:** Perubahan qty memperbarui total tanpa reload; item yang stoknya habis ditandai dan tidak dapat di-checkout.

### F-08 Checkout

- **Tujuan:** Menyelesaikan pembelian dengan langkah minimal.
- **Input:** Nama, HP, email, alamat, kota, provinsi, kode pos, catatan; metode pengiriman; metode pembayaran; voucher.
- **Output:** Order summary jelas, konfirmasi order.
- **Logic:** Satu halaman (alamat → pengiriman → pembayaran → ringkasan); ongkir dihitung dari kota tujuan dan berat (integrasi ekspedisi/RajaOngkir atau setara); Same Day hanya jika alamat masuk area layanan; COD hanya jika diaktifkan dan di area tertentu; stok dikunci sementara selama pembayaran (mis. 30 menit–24 jam sesuai metode).
- **AC:** Validasi inline (format HP, email, kode pos); order tidak dapat dibuat jika stok kurang; guest checkout didukung; total di server = total di UI.

### F-09 Payment

- **Tujuan:** Pembayaran aman dan beragam.
- **Metode:** Bank Transfer, QRIS, E-Wallet, Virtual Account, COD (opsional). Disarankan memakai payment gateway (mis. Midtrans/Xendit/Duitku).
- **Output:** Instruksi bayar, countdown batas waktu, status real-time.
- **Logic:** Status pembayaran diperbarui via webhook yang diverifikasi signature; order otomatis batal bila melewati batas waktu dan stok dikembalikan; transfer manual: upload bukti → konfirmasi admin.
- **AC:** Webhook idempotent (tidak memproses ganda); customer dapat melanjutkan pembayaran dari Order History.

### F-10 Order Tracking

- **Tujuan:** Transparansi status pesanan.
- **Status:** Order Placed → Payment Confirmed → Processing → Packed → Shipped → In Transit → Delivered → Completed.
- **Output:** Timeline visual (stepper berikon), nomor resi, link lacak ekspedisi, estimasi tiba.
- **Logic:** Status hanya maju sesuai urutan (kecuali Cancelled/Refunded); Delivered → otomatis Completed setelah 3 hari bila tidak ada komplain; tiap perubahan status mengirim notifikasi.
- **AC:** Timeline terbaca di layar 360 px; tiap langkah menampilkan tanggal/waktu.

### F-11 Customer Account

- **Fitur:** Register, login, edit profil, ganti password, kelola alamat, riwayat order, wishlist, review saya, logout, lupa password.
- **Logic:** Email unik; password min. 8 karakter; alamat utama dapat ditandai; verifikasi email disarankan.
- **AC:** Reset password via link kedaluwarsa 60 menit; sesi dapat dicabut saat logout.

### F-12 Promosi & Voucher

- **Fitur:** Diskon produk, voucher (persentase/nominal), minimum belanja, maksimum diskon, periode, batas pemakaian, kode, Flash Sale, Bundle, Buy 2 Get Discount, Free Shipping, label New Collection/Limited Stock/Best Seller.
- **Logic:** Urutan perhitungan: harga produk → diskon produk/flash sale → voucher → ongkir (free shipping). Voucher tidak bisa digabung kecuali diatur; batas pemakaian global dan per user.
- **Urgensi elegan:** "Only 5 left", "Ends tonight", "20% OFF", countdown halus; tanpa popup agresif.
- **AC:** Voucher kedaluwarsa/limit habis menampilkan pesan jelas; perhitungan sama persis di cart, checkout, dan invoice.

### F-13 Newsletter

- **Input:** Email. **Output:** Kode voucher 10% pengguna baru via email.
- **Logic:** Satu email = satu voucher; validasi duplikat; double opt-in direkomendasikan.
- **AC:** Pesan sukses elegan; email tersimpan untuk kampanye.

### F-14 Halaman Statis & Informasi

- About Us, Contact (form + WhatsApp + maps), FAQ (accordion, kategori), Terms & Conditions, Privacy Policy, Promo/Sale. Konten dikelola dari Website Content Management.
- **AC:** Form kontak ber-captcha/rate limit; setiap halaman memiliki meta SEO.

### F-15 Admin: Dashboard & Analytics

- Overview: Total Revenue, Total Orders, Total Products, Total Customers, Pending Orders, Low Stock Products.
- Chart: revenue harian/mingguan/bulanan, orders per hari, best selling products & categories.
- **AC:** Filter rentang tanggal; data \< 3 detik; ekspor CSV/Excel.

### F-16 Admin: Product Management

- Add/edit/delete (soft delete), upload banyak gambar (drag & drop, urutan, kompres otomatis), harga, stok, varian, kategori, diskon, tandai Featured/Best Seller, status Draft/Published.
- **Logic:** SKU unik; produk yang pernah dipesan tidak dihapus permanen; slug otomatis dari nama.
- **AC:** Validasi wajib (nama, kategori, harga, minimal 1 gambar, minimal 1 varian); preview sebelum publish.

### F-17 Admin: Inventory

- Stok per varian, riwayat pergerakan (masuk/keluar/penyesuaian/order), ambang low-stock, notifikasi.
- **Logic:** Stok berkurang saat pembayaran terkonfirmasi (atau saat reservasi), bertambah saat batal/retur.
- **AC:** Stok tidak boleh negatif; setiap perubahan tercatat (siapa, kapan, alasan).

### F-18 Admin: Order Management

- Lihat/cari/filter order, detail, konfirmasi pembayaran, ubah status, input resi, batalkan order, cetak invoice/label.
- **AC:** Transisi status tervalidasi; setiap perubahan tercatat di audit log dan memicu notifikasi customer.

### F-19 Admin: Customer Management

- Daftar, pencarian, riwayat pembelian, total belanja, aktivitas (wishlist, produk dilihat), segmentasi (baru, repeat, VIP).
- **AC:** Data pribadi hanya dapat diakses role berwenang.

### F-20 Admin: Voucher, Banner, Review, Content, Settings

- **Voucher:** persentase/nominal, min. belanja, maks. diskon, mulai/akhir, batas pakai, kode.
- **Banner:** gambar desktop/mobile, link, jadwal, urutan.
- **Review:** approve/hide/reply.
- **Content:** edit About, FAQ, T&C, Privacy, testimonial, link sosial.
- **Store Settings:** profil toko, ekspedisi, metode bayar, pajak, template email, ambang low-stock, jam operasional.
- **AC:** Perubahan tampil di storefront ≤ 1 menit (cache invalidation).

### F-21 Admin: Sales Report & KPI

- Laporan penjualan, revenue, AOV, conversion rate, returning customers, produk paling dilihat, cart abandonment, voucher usage; ekspor.
- **AC:** Definisi metrik konsisten (lihat Bagian 25).

---

## 9. Non-Functional Requirements

| Kategori | Requirement |
| --- | --- |
| Performa | LCP \< 2,5 s, CLS \< 0,1, INP \< 200 ms (4G mobile); TTFB \< 600 ms |
| Ketersediaan | Uptime ≥ 99,5%; backup database harian, retensi 14 hari |
| Skalabilitas | Mendukung ≥ 1.000 pengunjung bersamaan dan 5.000+ produk tanpa redesign |
| Kompatibilitas | Chrome, Safari, Firefox, Edge (2 versi terakhir); iOS 14+, Android 9+ |
| Responsif | 360 px hingga 1920 px; mobile-first |
| Aksesibilitas | Kontras teks ≥ 4,5:1, target sentuh ≥ 44 px, navigasi keyboard, alt text, label form |
| Keamanan | Lihat Bagian 22 |
| Maintainability | Kode modular, dokumentasi API, test coverage inti ≥ 70%, CI/CD |
| Lokalisasi | Bahasa Indonesia (default), siap Inggris; mata uang IDR, zona waktu WIB/WITA/WIT |
| Observability | Error tracking, log terstruktur, monitoring uptime |

**Saran tech stack (opsional):** Frontend Next.js/React + Tailwind CSS; Backend Laravel atau Node (NestJS); Database MySQL/PostgreSQL; Cache Redis; Storage gambar S3/Cloudinary + CDN; Payment gateway Midtrans/Xendit; Ongkir RajaOngkir/Biteship; Email via SMTP/SES; Hosting VPS/cloud dengan CDN.

## 10. Information Architecture

```
Home
├─ Shop
│  ├─ Pashmina · Hijab Segi Empat · Voal · Satin · Ceruty
│  ├─ Instant Hijab · Hijab Premium · New Collection
│  └─ Search Result
├─ Product Detail (/product/{slug})
├─ Promo / Sale
├─ Wishlist · Cart · Checkout → Payment → Order Confirmation
├─ Akun: Login · Register · Profile · Addresses · Order History · Order Tracking · My Reviews
└─ Info: About Us · Contact · FAQ · Terms & Conditions · Privacy Policy

Admin
├─ Login
├─ Dashboard
├─ Catalog: Products · Categories · Inventory
├─ Sales: Orders · Customers · Reviews
├─ Marketing: Vouchers · Promo Banners · Wishlist/Customer Insights
├─ Reports: Sales Report · Revenue Analytics
└─ Settings: Website Content · Admin Profile · Store Settings
```

**Navigasi:** Header (logo, menu kategori, search, wishlist, cart, akun); mobile: hamburger + bottom navigation (Home, Shop, Wishlist, Cart, Akun); footer (link info, sosial media, newsletter, metode bayar).

## 11. Page Structure

| Halaman | URL | Komponen utama |
| --- | --- | --- |
| Home | `/` | Hero, kategori, best seller, new arrivals, banner, why us, testimoni, IG gallery, newsletter |
| Shop | `/shop`, `/shop/{kategori}` | Breadcrumb, filter, sort, grid, pagination |
| Product Detail | `/product/{slug}` | Galeri, info, varian, CTA, tab detail, review, related |
| Search | `/search?q=` | Hasil, filter, saran |
| Wishlist | `/wishlist` | Grid produk tersimpan |
| Cart | `/cart` | Item, ringkasan, voucher, rekomendasi |
| Checkout | `/checkout` | Form, pengiriman, pembayaran, ringkasan |
| Payment | `/payment/{order}` | Instruksi, countdown, status |
| Tracking | `/orders/{no}/tracking` | Timeline, resi |
| Login/Register | `/login`, `/register` | Form, social login (opsional) |
| Profile | `/account/*` | Profil, alamat, order history, review |
| Statis | `/about`, `/contact`, `/faq`, `/terms`, `/privacy`, `/promo` | Konten CMS |
| Admin | `/admin/*` | Sesuai Bagian 20 |

## 12. UI/UX Guidelines

- **Mobile-first:** desain mulai 360 px; CTA utama di zona jempol; sticky "Add to Cart" di halaman produk mobile.
- **Hierarki visual:** foto produk dominan; heading serif elegan; ruang putih lega.
- **Kesan premium:** palet terbatas, bayangan lembut, sudut membulat secukupnya (8–16 px), gradien halus.
- **Interaksi:** hover lembut (naik 2–4 px + shadow), transisi 200–300 ms ease-out, micro-interaction pada wishlist (hati berdenyut halus), add to cart (ikon cart "bounce" ringan), skeleton loading.
- **Floral:** dekoratif, opacity rendah, di sudut/divider/background; tidak menutupi produk atau teks.
- **Urgensi elegan:** teks kecil bernada tenang ("Hanya tersisa 5"), bukan banner merah berkedip.
- **Form:** validasi inline, label jelas, autofill, input numerik untuk HP/kode pos.
- **Empty & error state:** ilustrasi floral line-art, pesan ramah, CTA lanjut belanja.
- **Hindari:** tampilan marketplace ramai, terlalu banyak warna, ilustrasi bunga bergaya kartun/childish.
- **Aksesibilitas:** jangan hanya mengandalkan warna pink untuk status; gunakan ikon + teks.

## 13. Design System

**Fondasi (design tokens)**

- Spacing: skala 4 px (4, 8, 12, 16, 24, 32, 48, 64, 96).
- Radius: sm 8 · md 12 · lg 16 · pill 999.
- Shadow: `sm 0 2px 8px rgba(58,48,51,.06)` · `md 0 8px 24px rgba(58,48,51,.08)` · `lg 0 16px 40px rgba(217,143,175,.18)`.
- Grid: 4 kolom (mobile), 8 (tablet), 12 (desktop), container maks 1280 px.
- Breakpoint: 360 · 768 · 1024 · 1280 · 1536.
- Motion: durasi 150/250/400 ms; easing `cubic-bezier(.2,.8,.2,1)`; hormati `prefers-reduced-motion`.

**Floral Design System (reusable)**

| Aset | Gaya | Penempatan | Aturan |
| --- | --- | --- | --- |
| Floral Corner | Line-art mawar/peony, 1–1,5 px stroke, mauve/gold | Sudut hero, kartu promo, modal | Maks 20% lebar kontainer, opacity 30–60% |
| Flower Line Art | Tulip, rose, peony garis tipis | Header section, empty state | Monokrom (mauve/dusty pink) |
| Small Flowers | Bunga kecil 8–16 px | Pemisah, bullet, rating accent | Jarang, konsisten |
| Botanical Leaves | Daun tipis, soft gold | Footer, divider | Tidak melewati teks |
| Flower Divider | Garis dengan bunga kecil di tengah | Antar-section | Satu per section maks |
| Floral Pattern | Pola ulang halus, opacity 5–8% | Background cream (promo, footer) | Tidak di belakang teks panjang |

Format aset: SVG (ringan, skalabel, warna via token). Aturan penggunaan: tidak menutupi produk, tidak mengganggu keterbacaan, ukuran proporsional, gaya garis konsisten di seluruh halaman, `aria-hidden="true"` dan `pointer-events: none`.

## 14. Color Palette

| Peran | Nama | Hex | Penggunaan |
| --- | --- | --- | --- |
| Primary | Soft Pink | `#F8C8DC` | Background section, badge lembut, hover |
| Primary | Rose Pink | `#EFA7C1` | Aksen, ikon aktif, border fokus |
| Primary | Dusty Pink | `#D98FAF` | Tombol sekunder, link, highlight |
| Secondary | Cream | `#FFF9F5` | Background utama |
| Secondary | White | `#FFFFFF` | Kartu, form |
| Secondary | Charcoal | `#3A3033` | Teks utama |
| Accent | Soft Gold | `#C9A227` | Garis tipis, badge Best Seller, ikon premium |
| Accent | Mauve | `#B97897` | Tombol utama/CTA, heading aksen, floral |

**Aturan proporsi:** ±60% cream/white, 25% soft pink & dusty pink, 10% charcoal (teks), 5% gold/mauve. **Catatan kontras:** teks putih di atas `#EFA7C1`/`#D98FAF` kontrasnya rendah; untuk tombol CTA gunakan Mauve `#B97897` dengan teks putih tebal, atau Charcoal pada pink muda. Verifikasi seluruh pasangan warna ≥ 4,5:1 (WCAG AA). **Semantik tambahan (minimal, selaras):** sukses `#6FA287`, peringatan `#D9A441`, error `#C0504D`, info `#8C7AA9`.

## 15. Typography

| Peran | Font | Ukuran (mobile/desktop) | Weight |
| --- | --- | --- | --- |
| Display / H1 | Playfair Display | 32 / 56 px | 600–700 |
| H2 | Playfair Display / Cormorant Garamond | 26 / 40 px | 600 |
| H3 | Cormorant Garamond | 20 / 28 px | 600 |
| Body | Poppins atau Inter | 15 / 16 px, line-height 1,6 | 400 |
| Caption/Label | Inter | 12–13 px | 500 |
| Tombol | Poppins | 14–15 px, letter-spacing .02em | 500–600 |
| Harga | Inter/Poppins | 16–20 px | 600 |

Gunakan `font-display: swap`, subset Latin, maksimal 2 keluarga font + 3 weight untuk menjaga performa.

## 16. Component System

| Komponen | Varian & state | Catatan |
| --- | --- | --- |
| Button | Primary (mauve), Secondary (outline), Ghost, Icon; hover/active/disabled/loading | Radius pill/12 px |
| Input/Select/Checkbox/Radio | default, focus (ring rose), error, disabled | Label di atas, helper text |
| Product Card | default, hover (zoom gambar 1,03), sold-out | Badge: Best Seller (gold), Sale %, New, Limited |
| Category Card | gambar + judul + floral minimal | Rasio 4:5 |
| Badge/Tag | Best Seller, New, Sale, Only X left | Pill kecil |
| Rating | bintang gold, jumlah review | Setengah bintang |
| Variant Selector | swatch warna, chip ukuran | Disabled bila habis |
| Quantity Selector | − / angka / + | Min 1, maks stok |
| Navbar / Bottom Nav | sticky, shrink on scroll | Badge jumlah cart |
| Search Bar | autocomplete dropdown | Riwayat pencarian |
| Filter Drawer / Sidebar | akordeon, chip filter aktif, "Reset" |  |
| Gallery | thumbnail, zoom, swipe | Lazy loading |
| Stepper/Timeline | 8 status order | Ikon + tanggal |
| Toast / Modal / Drawer | sukses/error/info | Mini-cart drawer |
| Accordion | FAQ, detail produk |  |
| Banner | Promo dengan floral, countdown |  |
| Table (admin) | sort, filter, bulk action, pagination |  |
| Chart (admin) | line, bar, donut | Palet pink-mauve-gold |
| Empty State / Skeleton | ilustrasi floral line-art |  |
| Footer | link, newsletter, sosial, pembayaran | Floral divider halus |

---

## 17. Database Schema

**Konvensi:** PK `id` (BIGINT unsigned auto-increment atau UUID); `created_at`, `updated_at` di semua tabel; `deleted_at` (soft delete) pada users, products, vouchers; uang disimpan integer (Rupiah) atau DECIMAL(12,0); *R* = required, *O* = optional.

### Diagram relasi (ringkas)

```
users 1─* addresses          users 1─* carts 1─* cart_items *─1 product_variants
users 1─* wishlists *─1 products
categories 1─* products 1─* product_variants 1─1 inventory
products 1─* product_images
users 1─* orders 1─* order_items *─1 product_variants
orders 1─* payments        orders 1─* shipments
orders *─0..1 vouchers 1─* voucher_usages *─1 users
products 1─* reviews *─1 users (reviews terkait order_items)
users 1─* notifications     banners (mandiri)
```

### Tabel

**users**

- PK: `id`. Unique: `email`.
- R: name, email, password_hash, role (`customer|admin`), is_active.
- O: phone, avatar, gender, birth_date, email_verified_at, last_login_at, remember_token.
- Index: `UNIQUE(email)`, `(role)`, `(phone)`.

**addresses**

- PK `id`; FK `user_id → users.id` (ON DELETE CASCADE).
- R: recipient_name, phone, address_line, city, province, postal_code. O: label, district, notes, latitude, longitude, is_default.
- Index: `(user_id, is_default)`.

**categories**

- PK `id`; FK `parent_id → categories.id` (nullable, self-reference).
- R: name, slug (unique), is_active. O: description, image, sort_order, meta_title, meta_description.
- Index: `UNIQUE(slug)`, `(parent_id, sort_order)`.

**products**

- PK `id`; FK `category_id → categories.id`.
- R: name, slug (unique), description, base_price, status (`draft|published|archived`).
- O: material, care_instructions, size_info, discount_type (`percent|fixed`), discount_value, discount_start, discount_end, is_featured, is_best_seller, is_new, weight_gram, rating_avg, review_count, total_sold, view_count, meta_title, meta_description.
- Index: `UNIQUE(slug)`, `(category_id, status)`, `(is_featured)`, `(created_at)`, `(total_sold)`, `(base_price)`, FULLTEXT `(name, description, material)`.

**product_variants**

- PK `id`; FK `product_id → products.id` (CASCADE).
- R: sku (unique), color, price (override harga; jika null pakai base_price), is_active. O: color_hex, size, image_id, weight_gram.
- Index: `UNIQUE(sku)`, `(product_id, is_active)`, `(color)`.

**product_images**

- PK `id`; FK `product_id`; FK `variant_id` (nullable).
- R: url, sort_order. O: alt_text, is_primary, width, height.
- Index: `(product_id, sort_order)`.

**inventory**

- PK `id`; FK `variant_id → product_variants.id` (UNIQUE, 1:1).
- R: quantity, reserved_quantity (default 0), low_stock_threshold (default 5). O: last_restock_at.
- Pencatatan pergerakan: tabel tambahan `inventory_movements` (variant_id, type, qty, reason, user_id, reference_id) untuk audit.
- Index: `UNIQUE(variant_id)`, `(quantity)`.

**carts**

- PK `id`; FK `user_id` (nullable untuk guest) ; O: session_id, voucher_id, expires_at.
- Index: `(user_id)`, `(session_id)`.

**cart_items**

- PK `id`; FK `cart_id` (CASCADE), FK `variant_id`.
- R: quantity. O: price_snapshot.
- Index: `UNIQUE(cart_id, variant_id)`.

**wishlists**

- PK `id`; FK `user_id`, FK `product_id`.
- Index: `UNIQUE(user_id, product_id)`.

**orders**

- PK `id`; FK `user_id` (nullable untuk guest), FK `voucher_id` (nullable), FK `address_id` (nullable; alamat di-snapshot).
- R: order_number (unique), customer_name, customer_phone, customer_email, shipping_address (snapshot JSON/teks), subtotal, discount_total, shipping_cost, grand_total, status (`pending_payment|payment_confirmed|processing|packed|shipped|in_transit|delivered|completed|cancelled|refunded`), payment_status.
- O: notes, cancel_reason, placed_at, paid_at, completed_at, expires_at.
- Index: `UNIQUE(order_number)`, `(user_id, created_at)`, `(status, created_at)`.

**order_items**

- PK `id`; FK `order_id` (CASCADE), FK `variant_id`, FK `product_id`.
- R: product_name_snapshot, variant_snapshot, unit_price, quantity, line_total. O: discount_amount.
- Index: `(order_id)`, `(product_id)`.

**payments**

- PK `id`; FK `order_id`.
- R: method (`bank_transfer|qris|ewallet|va|cod`), amount, status (`pending|paid|failed|expired|refunded`). O: gateway, gateway_reference, va_number, proof_url, paid_at, expired_at, raw_payload (JSON).
- Index: `(order_id)`, `UNIQUE(gateway_reference)`, `(status)`.

**shipments**

- PK `id`; FK `order_id`.
- R: courier, service (regular/express/same_day), cost, status. O: tracking_number, shipped_at, delivered_at, estimated_arrival, tracking_events (JSON).
- Index: `(order_id)`, `(tracking_number)`.

**reviews**

- PK `id`; FK `product_id`, FK `user_id`, FK `order_item_id` (UNIQUE).
- R: rating (1–5), status (`pending|approved|hidden`). O: title, comment, photos (JSON), admin_reply, is_verified.
- Index: `(product_id, status, created_at)`, `UNIQUE(order_item_id)`.

**vouchers**

- PK `id`.
- R: code (unique), type (`percent|fixed|free_shipping`), value, start_at, end_at, is_active. O: min_purchase, max_discount, usage_limit, usage_limit_per_user, used_count, description.
- Index: `UNIQUE(code)`, `(is_active, start_at, end_at)`.

**voucher_usages**

- PK `id`; FK `voucher_id`, FK `user_id` (nullable), FK `order_id`.
- R: discount_amount, used_at.
- Index: `(voucher_id, user_id)`, `UNIQUE(order_id, voucher_id)`.

**banners**

- PK `id`.
- R: title, image_desktop, image_mobile, position (`hero|promo|popup`), is_active. O: subtitle, link_url, cta_text, start_at, end_at, sort_order.
- Index: `(position, is_active, sort_order)`.

**notifications**

- PK `id`; FK `user_id` (nullable untuk notifikasi admin global).
- R: type, title, message, channel (`email|whatsapp|in_app`). O: data (JSON), read_at, sent_at.
- Index: `(user_id, read_at)`, `(type)`.

**Tabel pendukung yang disarankan:** `newsletter_subscribers`, `product_views` (untuk "most viewed" & rekomendasi), `audit_logs`, `store_settings`, `pages` (konten CMS), `inventory_movements`, `bundles`.

## 18. Role & Permission

| Kapabilitas | Guest | Customer | Admin/Owner |
| --- | --- | --- | --- |
| Lihat produk, search, FAQ | ✔ | ✔ | ✔ |
| Cart & checkout | ✔ (guest) | ✔ | ✔ |
| Wishlist | – | ✔ | – |
| Riwayat order, tracking, profil | – | ✔ (milik sendiri) | ✔ (semua) |
| Review produk | – | ✔ (verified purchase) | Moderasi |
| Kelola produk, kategori, stok | – | – | ✔ |
| Kelola order & pembayaran | – | – | ✔ |
| Kelola customer | – | – | ✔ |
| Voucher, banner, konten | – | – | ✔ |
| Laporan & analytics | – | – | ✔ |
| Store settings, manajemen admin | – | – | ✔ (Owner) |

Role minimal: **Customer** dan **Owner/Admin**. Rekomendasi masa depan: role **Staff** (hanya order & stok) dan **Content Editor** (banner/konten) dengan RBAC berbasis permission. Customer hanya boleh mengakses data miliknya (cek kepemilikan di server, bukan hanya UI).

## 19. Recommendation System

**Pendekatan:** rule-based sederhana (Fase 1), mudah diganti engine ML kemudian.

| Placement | Logika | Fallback |
| --- | --- | --- |
| Related Products (detail) | Skor = kategori sama (×3) + material sama (×2) + warna serupa (×1) + harga ±25% (×2) | Best seller kategori yang sama |
| You May Also Like (cart) | Frequently bought together (pasangan item dalam order yang sama, 90 hari) | Produk terkait item di cart |
| Untuk Anda (home, login) | Kategori & warna paling sering dilihat/dibeli + histori pembelian, kecuali yang sudah dibeli | Best seller |
| Guest | Produk dilihat dalam sesi (cookie) | Best seller / new arrivals |

**Aturan:** tampilkan 4–8 item; sembunyikan produk habis stok; hindari duplikat dengan isi cart; hitung ulang batch harian (cron) dan cache hasilnya. **Sinyal data:** `product_views`, `order_items`, `wishlists`, atribut produk. **Evolusi:** collaborative filtering → embedding/vector similarity → personalisasi real-time (lihat Roadmap). **AC:** blok rekomendasi muncul \< 500 ms; CTR rekomendasi dilacak.

## 20. Admin Dashboard Requirements

**Halaman & isi**

1. **Admin Login:** email + password, rate limit, opsional 2FA.
2. **Dashboard:** kartu KPI (Revenue, Orders, Products, Customers, Pending Orders, Low Stock), grafik revenue (harian/mingguan/bulanan), orders/hari, best selling product & category, aktivitas terbaru, shortcut tugas (konfirmasi pembayaran, restock).
3. **Product Management:** tabel + pencarian + bulk action; form tambah/edit dengan varian, gambar, SEO, diskon, flag Featured/Best Seller.
4. **Category Management:** CRUD, urutan, gambar, SEO.
5. **Inventory:** stok per varian, penyesuaian, riwayat, ambang low-stock.
6. **Order Management:** filter status/tanggal/metode; detail order; konfirmasi bayar; ubah status; input resi; batalkan; cetak invoice/label.
7. **Customer Management:** daftar, pencarian, histori beli, total belanja, aktivitas.
8. **Voucher Management:** semua atribut Bagian 8 F-20, statistik pemakaian.
9. **Promo Banner Management:** jadwal, urutan, preview desktop/mobile.
10. **Review Management:** moderasi, balas, laporkan.
11. **Wishlist / Customer Insights:** produk paling banyak di-wishlist, pencarian tanpa hasil, produk dilihat.
12. **Sales Report & Revenue Analytics:** ringkasan, per produk/kategori/periode, ekspor CSV/Excel.
13. **Website Content Management:** About, FAQ, testimonial, T&C, Privacy, link sosial.
14. **Admin Profile:** data diri, ganti password, sesi aktif.
15. **Store Settings:** profil toko, ekspedisi, pembayaran, pajak, notifikasi, low-stock default.

**Prinsip UX admin:** layout bersih selaras brand (pink lembut minimal, ruang putih), mobile-friendly (owner sering memakai HP), aksi utama dalam 2 klik, konfirmasi untuk aksi destruktif, pencarian global.

## 21. E-commerce Workflow

1. **Browse & pilih:** customer memilih varian → sistem cek stok.
2. **Cart:** item tersimpan; harga & stok divalidasi ulang.
3. **Checkout:** isi data → pilih pengiriman (ongkir dihitung) → voucher → pilih pembayaran → **Order dibuat** (`pending_payment`), stok direservasi.
4. **Payment:** gateway/transfer → webhook/konfirmasi admin → `payment_confirmed`; jika kedaluwarsa → `cancelled` + stok dilepas.
5. **Fulfillment:** `processing` → `packed` → admin input resi → `shipped` → `in_transit`.
6. **Delivery:** `delivered` → (3 hari) `completed` → undangan review + voucher repeat order.
7. **Pasca:** review, retur/komplain (kebijakan di T&C), pengembalian dana → `refunded`.
8. **Notifikasi** di setiap transisi (email, opsional WhatsApp).

**Aturan stok:** reserved saat order dibuat → dikurangi permanen saat bayar → dikembalikan saat batal/retur. **COD:** langsung `processing` setelah verifikasi; pembayaran dicatat saat `delivered`.

## 22. Security Requirements

| Area | Requirement |
| --- | --- |
| Authentication | Password di-hash (bcrypt/Argon2), min. 8 karakter, reset password via token berbatas waktu, sesi aman (HttpOnly, Secure, SameSite), opsional 2FA admin |
| Authorization | RBAC, cek kepemilikan resource di server (cegah IDOR), route admin terpisah & terlindungi |
| Input Validation | Validasi server-side untuk semua input, batasi ukuran/tipe upload (JPEG/PNG/WebP), rename file, scan tipe MIME |
| CSRF | Token CSRF pada semua request pengubah state |
| SQL Injection | Prepared statement / ORM, tanpa query string concatenation |
| XSS | Output escaping, sanitasi konten rich-text, Content-Security-Policy |
| Secure Checkout | HTTPS wajib + HSTS, tidak menyimpan data kartu (diserahkan ke payment gateway/PCI-DSS), verifikasi signature webhook, harga dihitung ulang di server |
| Rate Limiting | Login (mis. 5/menit), register, reset password, voucher, kontak, pencarian; blokir sementara + captcha |
| Data Protection | Enkripsi at-rest untuk data sensitif, backup terenkripsi, minimisasi data pribadi, mengikuti UU PDP Indonesia |
| Infrastruktur | Header keamanan (X-Frame-Options, X-Content-Type-Options), dependensi diperbarui, secret di environment variable, WAF/CDN |
| Audit | Log perubahan harga, stok, status order, aksi admin |

## 23. SEO Requirements

- **URL:** `/shop`, `/shop/pashmina`, `/product/pashmina-silk-premium`; huruf kecil, tanda hubung, tanpa ID mentah; canonical untuk halaman filter/duplikat.
- **Meta:** title (≤ 60 karakter) dan description (≤ 155 karakter) unik per halaman, template otomatis yang dapat di-override admin. Contoh: *"Pashmina Silk Premium | \[Nama Brand\]"*.
- **Open Graph & Twitter Card:** og:title, og:description, og:image (1200×630), og:type=product.
- **Structured Data (JSON-LD):** `Product` (name, image, description, sku, brand, offers, aggregateRating, review), `BreadcrumbList`, `Organization`, `FAQPage`.
- **Sitemap & Robots:** `sitemap.xml` otomatis (produk, kategori, halaman statis), `robots.txt` (blokir `/admin`, `/cart`, `/checkout`, `/account`).
- **Gambar:** alt text deskriptif (otomatis dari nama produk + warna, dapat diedit), nama file bermakna, format WebP/AVIF.
- **Teknis:** SSR/SSG untuk halaman publik, Core Web Vitals hijau, internal linking (related products, breadcrumb), pagination `rel` yang benar, halaman 404 ramah, 301 redirect saat slug berubah.
- **Lokal:** Google Business Profile, bahasa Indonesia (`lang="id"`).

## 24. Performance Requirements

| Area | Requirement |
| --- | --- |
| Target | Home terasa cepat: LCP \< 2,5 s (4G), halaman produk \< 3 s, checkout interaktif \< 2 s |
| Gambar | WebP/AVIF, responsive `srcset`, lazy loading di bawah fold, dimensi tetap (cegah CLS), maks ±150 KB per gambar listing, hero ≤ 250 KB, kompres otomatis saat upload |
| Frontend | Code splitting, preload font & hero, defer script pihak ketiga, bundle JS awal \< 200 KB (gzip) |
| Backend | Query efisien (hindari N+1, eager loading), indeks sesuai Bagian 17, pagination (12–24 item/halaman), cursor pagination untuk data besar |
| Caching | CDN untuk aset statis, cache halaman katalog/kategori, Redis untuk sesi, cart, hasil rekomendasi; invalidasi saat produk/banner diubah |
| Checkout | Minim request, tanpa library berat, validasi lokal, state tersimpan |
| Monitoring | Lighthouse CI, RUM Core Web Vitals, alert saat respons > 1 s |

## 25. Analytics & KPI

| KPI | Definisi / Rumus | Lokasi |
| --- | --- | --- |
| Total Sales | Jumlah order berstatus paid/completed | Dashboard |
| Revenue | Σ grand_total order paid (tanpa order batal/refund) | Dashboard |
| Average Order Value | Revenue ÷ jumlah order | Dashboard |
| Conversion Rate | Order selesai ÷ sesi unik × 100% | Analytics |
| Number of Customers | Customer terdaftar + guest unik | Customer |
| Returning Customers | Customer dengan ≥ 2 order ÷ total customer yang pernah order | Analytics |
| Best Selling Products | Top-N berdasarkan qty/revenue per periode | Dashboard |
| Low Stock Products | Varian dengan stok ≤ ambang | Dashboard/Inventory |
| Most Viewed Products | Top-N `product_views` | Insights |
| Cart Abandonment | (Cart dibuat − order selesai) ÷ cart dibuat × 100% | Analytics |
| Voucher Usage | Jumlah pakai, total diskon, revenue yang dihasilkan per voucher | Voucher |

**Funnel:** Visit → Product View → Add to Cart → Checkout Start → Payment → Paid. **Tools:** GA4 + event e-commerce, Meta Pixel (opsional), Search Console, dashboard internal; event kunci: `view_item`, `add_to_cart`, `begin_checkout`, `purchase`, `search`, `apply_voucher`. Terapkan consent cookie sesuai kebijakan privasi.

## 26. Future Development Roadmap

| Fase | Periode (estimasi) | Cakupan |
| --- | --- | --- |
| **Fase 0: Discovery & Desain** | Minggu 1–3 | Finalisasi PRD, brand kit, wireframe, UI kit & floral design system, prototype Figma |
| **Fase 1: MVP** | Minggu 4–12 | Katalog, detail, cart, checkout, payment gateway, akun, tracking, admin dasar (produk, stok, order, voucher, banner), SEO dasar, rekomendasi rule-based |
| **Fase 2: Growth** | Bulan 4–6 | Flash sale, bundle, Buy 2 Get Discount, notifikasi WhatsApp, abandoned cart email, review dengan foto lengkap, analytics lanjutan, Staff role, loyalty point |
| **Fase 3: Scale** | Bulan 7–12 | Aplikasi mobile/PWA, multi-gudang, marketplace sync (Shopee/Tokopedia), social commerce (IG/TikTok Shop), live chat, program afiliasi/reseller |
| **Fase 4: Intelligence** | Tahun 2 | Recommendation engine ML, personalisasi real-time, virtual try-on/AI color matching, prediksi stok & demand forecasting, multi-bahasa & multi-mata uang (ekspor Malaysia/Brunei) |

**Risiko & mitigasi:** (1) Ukuran gambar membebani performa → pipeline kompresi otomatis; (2) stok tidak sinkron → reservasi + audit pergerakan; (3) fraud/COD gagal → batasi COD per area, verifikasi; (4) floral berlebihan → pedoman penggunaan & review desain; (5) scope creep → prioritas MVP ketat.

**Asumsi terbuka yang perlu dikonfirmasi owner:** nama brand, pilihan payment gateway & ekspedisi, kebijakan retur, ketersediaan COD/Same Day, sumber foto produk/model, kebutuhan WhatsApp checkout, tim yang mengoperasikan admin.

---

*Dokumen ini adalah blueprint development. Setiap fitur memiliki tujuan, user, input, output, interaksi, business logic, dan acceptance criteria untuk dijadikan user story/ticket.*