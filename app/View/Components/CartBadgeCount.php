<?php

namespace App\View\Components;

use App\Models\Cart;
use App\Services\CartService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

/**
 * Resolves the current cart item count for the navbar badge.
 * Read-only: reuses CartService::getCart() — never mutates cart state.
 */
class CartBadgeCount extends Component
{
    public int $count = 0;

    public function __construct(Request $request, protected CartService $cartService)
    {
        $cart = $this->cartService->getCart(
            $request->user(),
            $request->hasSession() ? $request->session()->getId() : null,
            $request->hasSession() ? $request->session()->get('cart_id') : null
        );

        if ($cart instanceof Cart) {
            $this->count = (int) $cart->items()->sum('quantity');
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.cart-badge-count', ['count' => $this->count]);
    }
}
