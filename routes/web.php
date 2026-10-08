<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Catalog Routes
Route::get('/shop', [CatalogController::class, 'index'])->name('shop.index');
Route::get('/shop/{category:slug}', [CatalogController::class, 'index'])->name('shop.category');
Route::get('/product/{product:slug}', [CatalogController::class, 'show'])->name('shop.product');

// Customer Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [CustomerAuthController::class, 'create'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'store'])->name('login.submit');
    Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.submit');
});

// Customer Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [CustomerAuthController::class, 'destroy'])->name('logout');
    // Customer Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

    // Customer Address Management
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::get('/addresses/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
    Route::post('/addresses/{address}/default', [AddressController::class, 'setDefault'])->name('addresses.default');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Customer Order History & Detail
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Wishlist Routes (Authenticated Customers)
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{product}/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

// Shopping Cart Routes (Guests and Customers)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/items', [CartController::class, 'store'])->name('cart.items.store');
Route::patch('/cart/items/{cartItem}', [CartController::class, 'update'])->name('cart.items.update');
Route::delete('/cart/items/{cartItem}', [CartController::class, 'destroy'])->name('cart.items.destroy');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.destroy');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'store'])->name('login.submit');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');

        // Category Management
        Route::resource('categories', CategoryController::class)->except(['show']);

        // Product Management
        Route::resource('products', ProductController::class)->except(['show']);

        // Product Variants
        Route::post('/products/{product}/variants', [ProductVariantController::class, 'store'])->name('products.variants.store');
        Route::put('/products/{product}/variants/{variant}', [ProductVariantController::class, 'update'])->name('products.variants.update');
        Route::delete('/products/{product}/variants/{variant}', [ProductVariantController::class, 'destroy'])->name('products.variants.destroy');
        Route::post('/products/{product}/variants/{variant}/stock', [ProductVariantController::class, 'updateStock'])->name('products.variants.stock');

        // Product Images
        Route::post('/products/{product}/images', [ProductImageController::class, 'store'])->name('products.images.store');
        Route::post('/products/{product}/images/{image}/primary', [ProductImageController::class, 'setPrimary'])->name('products.images.primary');
        Route::delete('/products/{product}/images/{image}', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
    });
});
