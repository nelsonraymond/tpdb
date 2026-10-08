<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Mutya storefront homepage (PRD F-01 / DESIGN.md §13–§25).
     */
    public function __invoke(): View
    {
        $activeProducts = fn () => Product::query()
            ->active()
            ->whereHas('category', fn ($q) => $q->active());

        return view('home', [
            // Full active category list — homepage mosaic + mobile nav render from real DB rows.
            'categories' => Category::query()
                ->active()
                ->with(['products' => fn ($q) => $q->active()->with('images')])
                ->orderBy('name')
                ->get(),
            'bestSellers' => $activeProducts()
                ->where('is_best_seller', true)
                ->with(['category', 'images', 'variants' => fn ($q) => $q->active()])
                ->latest()
                ->take(4)
                ->get(),
            'newArrivals' => $activeProducts()
                ->where('is_best_seller', false)
                ->with(['category', 'images', 'variants' => fn ($q) => $q->active()])
                ->latest()
                ->take(4)
                ->get(),
            'featuredProducts' => $activeProducts()
                ->where('is_featured', true)
                ->with(['category', 'images', 'variants' => fn ($q) => $q->active()])
                ->latest()
                ->take(1)
                ->get(),
            // Material spotlight: distinct real material values (no invented materials).
            'materials' => Product::query()
                ->active()
                ->whereNotNull('material')
                ->distinct()
                ->orderBy('material')
                ->limit(6)
                ->pluck('material'),
            // Social proof: only genuine published reviews; empty state handled in the view.
            'reviews' => Review::query()
                ->where('is_published', true)
                ->with(['user', 'product'])
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }
}
