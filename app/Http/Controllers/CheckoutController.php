<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use App\Services\ShippingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        protected CheckoutService $checkoutService,
        protected ShippingService $shippingService,
    ) {}

    /**
     * Display the checkout page.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        try {
            $cartData = $this->checkoutService->getValidatedCartData($user);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first('cart') ?: 'Keranjang belanja Anda kosong.';

            return redirect()->route('cart.index')->with('warning', $message);
        }

        $addresses = $user->addresses()
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        $shippingMethods = $this->shippingService->getAvailableMethods();
        $defaultShipping = 'regular';
        $shippingCost = $shippingMethods[$defaultShipping]['cost'];
        $subtotal = $cartData['subtotal'];
        $grandTotal = $subtotal + $shippingCost;

        return view('checkout.index', [
            'cart' => $cartData['cart'],
            'cartItems' => $cartData['items'],
            'subtotal' => $subtotal,
            'itemCount' => $cartData['itemCount'],
            'addresses' => $addresses,
            'defaultAddress' => $addresses->firstWhere('is_default', true) ?? $addresses->first(),
            'shippingMethods' => $shippingMethods,
            'defaultShipping' => $defaultShipping,
            'shippingCost' => $shippingCost,
            'grandTotal' => $grandTotal,
        ]);
    }

    /**
     * Handle order submission and confirmation.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'address_id' => [
                'required',
                'integer',
                Rule::exists('addresses', 'id')->where('user_id', $user->id),
            ],
            'shipping_method' => [
                'required',
                'string',
                Rule::in(array_keys($this->shippingService->getAvailableMethods())),
            ],
            'customer_note' => ['nullable', 'string', 'max:500'],
        ], [
            'address_id.required' => 'Silakan pilih atau tambahkan alamat pengiriman terlebih dahulu.',
            'address_id.exists' => 'Alamat pengiriman yang dipilih tidak valid atau bukan milik Anda.',
            'shipping_method.required' => 'Silakan pilih metode pengiriman.',
            'shipping_method.in' => 'Metode pengiriman yang dipilih tidak valid.',
        ]);

        try {
            $order = $this->checkoutService->placeOrder($user, $validated);

            return redirect()->route('orders.show', $order)
                ->with('success', "Pesanan #{$order->order_number} berhasil dibuat!");
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->validator);
        }
    }
}
