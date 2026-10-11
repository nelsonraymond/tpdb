<?php

namespace App\View\Components;

use App\Models\Wishlist;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

/**
 * Resolves the current customer's wishlist item count for the navbar badge.
 * Read-only count: only queries when user is authenticated.
 */
class WishlistBadgeCount extends Component
{
    public int $count = 0;

    public function __construct(Request $request)
    {
        if ($request->user()) {
            $this->count = (int) Wishlist::where('user_id', $request->user()->id)->count();
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.wishlist-badge-count', ['count' => $this->count]);
    }
}
