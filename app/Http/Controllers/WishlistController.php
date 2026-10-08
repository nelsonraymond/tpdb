<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WishlistController extends Controller
{
    /**
     * Display customer's wishlist items.
     */
    public function index(Request $request): View
    {
        $wishlists = Wishlist::where('user_id', $request->user()->id)
            ->with(['product.category', 'product.images', 'product.variants'])
            ->latest('created_at')
            ->paginate(12);

        return view('wishlist.index', compact('wishlists'));
    }

    /**
     * Toggle product in wishlist (add if not present, remove if present).
     */
    public function toggle(Request $request, Product $product): RedirectResponse
    {
        $existing = Wishlist::where('user_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = "Produk {$product->name} berhasil dihapus dari wishlist.";
        } else {
            Wishlist::firstOrCreate([
                'user_id' => $request->user()->id,
                'product_id' => $product->id,
            ]);
            $message = "Produk {$product->name} berhasil ditambahkan ke wishlist.";
        }

        return back()->with('success', $message);
    }

    /**
     * Remove product from wishlist.
     */
    public function destroy(Request $request, Product $product): RedirectResponse
    {
        Wishlist::where('user_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', "Produk {$product->name} dihapus dari wishlist.");
    }
}
