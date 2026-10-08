# ERD & Database Design — Hijab E-Commerce
Stack: Laravel + MySQL + Tailwind CSS

## 1. Architecture

Database dibuat untuk mendukung:
- Customer storefront
- Product catalog
- Product variants
- Cart & wishlist
- Checkout & order
- Payment & shipping
- Reviews
- Voucher/promo
- Admin/owner dashboard
- Sales & inventory reporting

### Prinsip desain

1. Gunakan normalized relational schema.
2. Pisahkan product dengan variant karena satu hijab dapat memiliki banyak warna/varian.
3. Simpan snapshot nama/harga pada `order_items` agar histori pesanan tidak berubah ketika produk diedit.
4. Jangan menyimpan data kartu kredit sensitif. Simpan hanya provider, reference, status, dan metadata yang aman.
5. Semua tabel transaksi memakai foreign key dan timestamp.
6. Gunakan soft delete hanya pada data yang memang perlu dipulihkan, misalnya products/categories.
7. Untuk Laravel, gunakan `created_at` dan `updated_at` pada tabel yang dikelola Eloquent.

---

# 2. ERD — DBML

Kode berikut dapat langsung ditempel ke dbdiagram.io.

```dbml
Table users {
  id bigint [pk, increment]
  name varchar(100)
  email varchar(150) [unique]
  phone varchar(30)
  password varchar(255)
  role enum('customer', 'admin') [default: 'customer']
  email_verified_at timestamp
  remember_token varchar(100)
  created_at timestamp
  updated_at timestamp
}

Table categories {
  id bigint [pk, increment]
  parent_id bigint [ref: > categories.id]
  name varchar(100)
  slug varchar(120) [unique]
  description text
  image varchar(255)
  is_active boolean [default: true]
  created_at timestamp
  updated_at timestamp
  deleted_at timestamp
}

Table products {
  id bigint [pk, increment]
  category_id bigint [ref: > categories.id]
  name varchar(180)
  slug varchar(200) [unique]
  sku varchar(80) [unique]
  description text
  material varchar(100)
  care_instructions text
  base_price decimal(12,2)
  compare_at_price decimal(12,2)
  is_featured boolean [default: false]
  is_best_seller boolean [default: false]
  is_active boolean [default: true]
  created_at timestamp
  updated_at timestamp
  deleted_at timestamp
}

Table product_variants {
  id bigint [pk, increment]
  product_id bigint [ref: > products.id]
  name varchar(120)
  sku varchar(80) [unique]
  color_name varchar(80)
  color_hex varchar(20)
  size varchar(50)
  additional_price decimal(12,2) [default: 0]
  stock_qty int [default: 0]
  low_stock_threshold int [default: 5]
  weight_gram int
  is_active boolean [default: true]
  created_at timestamp
  updated_at timestamp
}

Table product_images {
  id bigint [pk, increment]
  product_id bigint [ref: > products.id]
  variant_id bigint [ref: > product_variants.id]
  image_path varchar(255)
  alt_text varchar(255)
  sort_order int [default: 0]
  is_primary boolean [default: false]
  created_at timestamp
  updated_at timestamp
}

Table inventory_movements {
  id bigint [pk, increment]
  product_variant_id bigint [ref: > product_variants.id]
  type enum('in', 'out', 'adjustment', 'return')
  quantity int
  reference_type varchar(50)
  reference_id bigint
  note varchar(255)
  created_by bigint [ref: > users.id]
  created_at timestamp
}

Table carts {
  id bigint [pk, increment]
  user_id bigint [ref: > users.id]
  session_id varchar(120) [unique]
  created_at timestamp
  updated_at timestamp
}

Table cart_items {
  id bigint [pk, increment]
  cart_id bigint [ref: > carts.id]
  product_variant_id bigint [ref: > product_variants.id]
  quantity int
  unit_price decimal(12,2)
  created_at timestamp
  updated_at timestamp

  Indexes {
    (cart_id, product_variant_id) [unique]
  }
}

Table wishlists {
  id bigint [pk, increment]
  user_id bigint [ref: > users.id]
  product_id bigint [ref: > products.id]
  created_at timestamp

  Indexes {
    (user_id, product_id) [unique]
  }
}

Table addresses {
  id bigint [pk, increment]
  user_id bigint [ref: > users.id]
  label varchar(50)
  recipient_name varchar(120)
  phone varchar(30)
  address_line text
  village varchar(100)
  district varchar(100)
  city varchar(100)
  province varchar(100)
  postal_code varchar(10)
  notes varchar(255)
  is_default boolean [default: false]
  created_at timestamp
  updated_at timestamp
}

Table orders {
  id bigint [pk, increment]
  order_number varchar(40) [unique]
  user_id bigint [ref: > users.id]
  status enum('pending', 'confirmed', 'processing', 'packed', 'shipped', 'delivered', 'completed', 'cancelled')
  payment_status enum('pending', 'paid', 'failed', 'expired', 'refunded')
  subtotal decimal(12,2)
  discount_amount decimal(12,2) [default: 0]
  shipping_cost decimal(12,2) [default: 0]
  grand_total decimal(12,2)
  voucher_code varchar(50)
  voucher_discount decimal(12,2) [default: 0]

  shipping_recipient_name varchar(120)
  shipping_phone varchar(30)
  shipping_address text
  shipping_city varchar(100)
  shipping_province varchar(100)
  shipping_postal_code varchar(10)
  customer_note text

  placed_at timestamp
  created_at timestamp
  updated_at timestamp
}

Table order_items {
  id bigint [pk, increment]
  order_id bigint [ref: > orders.id]
  product_id bigint [ref: > products.id]
  product_variant_id bigint [ref: > product_variants.id]
  product_name varchar(180)
  variant_name varchar(120)
  sku varchar(80)
  unit_price decimal(12,2)
  quantity int
  subtotal decimal(12,2)
  created_at timestamp
  updated_at timestamp
}

Table payments {
  id bigint [pk, increment]
  order_id bigint [ref: > orders.id]
  provider varchar(50)
  payment_method varchar(50)
  transaction_reference varchar(150)
  amount decimal(12,2)
  status enum('pending', 'paid', 'failed', 'expired', 'refunded')
  paid_at timestamp
  metadata json
  created_at timestamp
  updated_at timestamp
}

Table shipments {
  id bigint [pk, increment]
  order_id bigint [ref: > orders.id]
  courier varchar(80)
  service varchar(80)
  tracking_number varchar(120)
  shipping_cost decimal(12,2)
  status enum('pending', 'picked_up', 'in_transit', 'delivered', 'returned')
  shipped_at timestamp
  delivered_at timestamp
  created_at timestamp
  updated_at timestamp
}

Table reviews {
  id bigint [pk, increment]
  product_id bigint [ref: > products.id]
  user_id bigint [ref: > users.id]
  order_item_id bigint [ref: > order_items.id]
  rating tinyint
  title varchar(120)
  comment text
  photo_path varchar(255)
  is_verified_purchase boolean [default: false]
  is_published boolean [default: true]
  created_at timestamp
  updated_at timestamp
  deleted_at timestamp
}

Table vouchers {
  id bigint [pk, increment]
  code varchar(50) [unique]
  type enum('percentage', 'fixed', 'free_shipping')
  value decimal(12,2)
  min_order_amount decimal(12,2)
  max_discount_amount decimal(12,2)
  usage_limit int
  usage_limit_per_user int
  used_count int [default: 0]
  starts_at timestamp
  expires_at timestamp
  is_active boolean [default: true]
  created_at timestamp
  updated_at timestamp
}

Table voucher_usages {
  id bigint [pk, increment]
  voucher_id bigint [ref: > vouchers.id]
  user_id bigint [ref: > users.id]
  order_id bigint [ref: > orders.id]
  discount_amount decimal(12,2)
  created_at timestamp
}

Table banners {
  id bigint [pk, increment]
  title varchar(150)
  subtitle varchar(255)
  image_path varchar(255)
  button_text varchar(50)
  button_url varchar(255)
  starts_at timestamp
  ends_at timestamp
  sort_order int [default: 0]
  is_active boolean [default: true]
  created_at timestamp
  updated_at timestamp
}

Table notifications {
  id bigint [pk, increment]
  user_id bigint [ref: > users.id]
  type varchar(80)
  title varchar(150)
  message text
  data json
  read_at timestamp
  created_at timestamp
  updated_at timestamp
}

Table product_views {
  id bigint [pk, increment]
  user_id bigint [ref: > users.id]
  product_id bigint [ref: > products.id]
  session_id varchar(120)
  created_at timestamp
}
```

---

# 3. Relationship Summary

## User

`users`
- hasMany `addresses`
- hasMany `orders`
- hasMany `reviews`
- hasOne/hasMany `cart`
- hasMany `wishlists`
- hasMany `notifications`
- hasMany `voucher_usages`

## Category

`categories`
- belongsTo `parent` category
- hasMany `children`
- hasMany `products`

## Product

`products`
- belongsTo `category`
- hasMany `product_variants`
- hasMany `product_images`
- hasMany `reviews`
- hasMany `wishlists`
- hasMany `order_items`

## Product Variant

`product_variants`
- belongsTo `product`
- hasMany `product_images`
- hasMany `cart_items`
- hasMany `order_items`
- hasMany `inventory_movements`

## Cart

`carts`
- belongsTo `user`
- hasMany `cart_items`

## Order

`orders`
- belongsTo `user`
- hasMany `order_items`
- hasMany `payments`
- hasOne `shipment`
- hasMany `voucher_usages`

## Review

`reviews`
- belongsTo `product`
- belongsTo `user`
- belongsTo `order_item`

## Voucher

`vouchers`
- hasMany `voucher_usages`

---

# 4. Important Business Rules

## Product

1. Product tidak boleh dibeli jika seluruh variannya `stock_qty <= 0`.
2. Product dapat memiliki banyak variant.
3. SKU harus unik.
4. Harga final variant:

```text
final_price = base_price + additional_price
```

5. Product yang `is_active = false` tidak tampil di storefront.

## Cart

1. Satu variant hanya boleh muncul sekali di cart yang sama.
2. Menambahkan variant yang sama harus menaikkan `quantity`.
3. `unit_price` disimpan sebagai snapshot harga saat item dimasukkan.
4. Saat checkout, harga harus divalidasi kembali dari database.

## Order

1. `order_number` harus unik.
2. `order_items` menyimpan snapshot:
   - product_name
   - variant_name
   - sku
   - unit_price
3. Perubahan nama/harga product tidak boleh mengubah histori order.
4. Stock dikurangi ketika order sudah berada pada status yang ditentukan bisnis, misalnya `confirmed` atau setelah pembayaran berhasil.
5. Order yang dibatalkan harus mengembalikan stock jika sebelumnya sudah dikurangi.

## Payment

1. Satu order dapat memiliki lebih dari satu payment record apabila ada retry pembayaran.
2. Hanya payment dengan status `paid` yang dianggap berhasil.
3. Simpan transaction reference dari payment gateway.
4. Jangan simpan nomor kartu atau CVV.

## Review

1. Rating hanya 1–5.
2. Review harus berasal dari customer.
3. Sebaiknya review hanya dapat dibuat untuk `order_item` yang sudah `completed`.
4. Satu order item hanya boleh memiliki satu review.
5. `is_verified_purchase = true` jika review berhasil divalidasi dari order.

## Voucher

1. Voucher harus berada di antara `starts_at` dan `expires_at`.
2. Periksa minimum order.
3. Periksa usage limit.
4. Periksa limit per user.
5. Jangan percaya nilai discount dari frontend; hitung ulang di backend.

---

# 5. Recommended Indexes

Wajib diperhatikan untuk performa:

```text
products:
- slug UNIQUE
- sku UNIQUE
- category_id
- is_active
- is_featured
- is_best_seller

product_variants:
- product_id
- sku UNIQUE
- color_name
- stock_qty

orders:
- order_number UNIQUE
- user_id
- status
- payment_status
- created_at

order_items:
- order_id
- product_id
- product_variant_id

reviews:
- product_id
- user_id
- order_item_id

product_views:
- product_id
- user_id
- created_at

vouchers:
- code UNIQUE
- starts_at
- expires_at
- is_active
```

---

# 6. Laravel Model Structure

Recommended Eloquent models:

```text
User
Category
Product
ProductVariant
ProductImage
InventoryMovement
Cart
CartItem
Wishlist
Address
Order
OrderItem
Payment
Shipment
Review
Voucher
VoucherUsage
Banner
Notification
ProductView
```

Recommended relations:

```php
// Product.php

public function category()
{
    return $this->belongsTo(Category::class);
}

public function variants()
{
    return $this->hasMany(ProductVariant::class);
}

public function images()
{
    return $this->hasMany(ProductImage::class);
}

public function reviews()
{
    return $this->hasMany(Review::class);
}
```

```php
// Order.php

public function user()
{
    return $this->belongsTo(User::class);
}

public function items()
{
    return $this->hasMany(OrderItem::class);
}

public function payments()
{
    return $this->hasMany(Payment::class);
}

public function shipment()
{
    return $this->hasOne(Shipment::class);
}
```

---

# 7. Suggested Laravel Project Structure

```text
app/
├── Models/
│   ├── User.php
│   ├── Category.php
│   ├── Product.php
│   ├── ProductVariant.php
│   ├── ProductImage.php
│   ├── InventoryMovement.php
│   ├── Cart.php
│   ├── CartItem.php
│   ├── Wishlist.php
│   ├── Address.php
│   ├── Order.php
│   ├── OrderItem.php
│   ├── Payment.php
│   ├── Shipment.php
│   ├── Review.php
│   ├── Voucher.php
│   ├── VoucherUsage.php
│   ├── Banner.php
│   └── ProductView.php

app/
├── Http/
│   ├── Controllers/
│   │   ├── Storefront/
│   │   └── Admin/
│   └── Requests/

database/
├── migrations/
├── seeders/
└── factories/
```

---

# 8. Recommended MVP vs Future

## MVP

Bangun terlebih dahulu:

```text
users
categories
products
product_variants
product_images
carts
cart_items
wishlists
addresses
orders
order_items
payments
reviews
```

Ditambah:
- Admin product CRUD
- Admin order management
- Checkout
- Payment integration
- Basic review
- Basic dashboard

## Phase 2

Tambahkan:

```text
shipments
vouchers
voucher_usages
inventory_movements
banners
notifications
```

## Phase 3

Untuk fitur data/rekomendasi:

```text
product_views
recommendation_logs
```

Kemudian recommendation engine dapat dikembangkan berdasarkan:
- product views
- wishlist
- purchase history
- category affinity
- color preference
- collaborative/content-based recommendation

---

# 9. Security Notes

Untuk Laravel:

- Gunakan Laravel authentication.
- Password harus menggunakan Laravel hashing.
- Gunakan policies/gates untuk akses admin.
- Gunakan Form Request validation.
- Gunakan CSRF protection.
- Jangan membuat query SQL dari string mentah yang berasal dari user.
- Gunakan Eloquent/query builder dan parameter binding.
- Validasi upload image.
- Batasi ukuran dan mime type file.
- Gunakan authorization untuk order/customer data.
- Payment webhook wajib diverifikasi.
- Jangan mempercayai harga, total, discount, atau stock yang dikirim frontend.

---

# 10. Recommended Implementation Order

Untuk vibe coding, implementasikan secara berurutan:

```text
1. Database migrations
2. Models + relationships
3. Seeders + factories
4. Authentication + role admin/customer
5. Product & category CRUD
6. Storefront + product listing
7. Product detail + variants
8. Cart
9. Wishlist
10. Address
11. Checkout
12. Order
13. Payment
14. Review
15. Admin dashboard
16. Voucher
17. Shipment/tracking
18. Recommendation
```

Jangan langsung membangun semua fitur sekaligus.

Pastikan setiap tahap berjalan sebelum lanjut ke tahap berikutnya.
