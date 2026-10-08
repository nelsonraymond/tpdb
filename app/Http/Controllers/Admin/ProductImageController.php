<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Upload and store a new image for the product.
     */
    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'image' => ['required', 'file', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
            'variant_id' => ['nullable', 'exists:product_variants,id'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_primary' => ['boolean'],
        ]);

        $path = $request->file('image')->store('products', 'public');

        $isPrimary = $request->boolean('is_primary');

        // If there are no images yet, automatically make the first one primary
        if ($isPrimary || $product->images()->count() === 0) {
            $product->images()->update(['is_primary' => false]);
            $isPrimary = true;
        }

        ProductImage::create([
            'product_id' => $product->id,
            'variant_id' => $validated['variant_id'] ?? null,
            'image_path' => $path,
            'alt_text' => $validated['alt_text'] ?? $product->name,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_primary' => $isPrimary,
        ]);

        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Gambar produk berhasil diunggah.');
    }

    /**
     * Set the image as the primary image for the product.
     */
    public function setPrimary(Product $product, ProductImage $image): RedirectResponse
    {
        $product->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Gambar utama berhasil diperbarui.');
    }

    /**
     * Delete the specified product image.
     */
    public function destroy(Product $product, ProductImage $image): RedirectResponse
    {
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $wasPrimary = $image->is_primary;
        $image->delete();

        // If the deleted image was primary, assign the first remaining image as primary
        if ($wasPrimary) {
            $product->images()->first()?->update(['is_primary' => true]);
        }

        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Gambar produk berhasil dihapus.');
    }
}
