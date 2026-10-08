<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AddressController extends Controller
{
    /**
     * Display a listing of the customer's addresses.
     */
    public function index(Request $request): View
    {
        $addresses = $request->user()->addresses()
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new address.
     */
    public function create(Request $request): View
    {
        $redirectTo = $request->query('redirect_to');

        return view('addresses.create', compact('redirectTo'));
    }

    /**
     * Store a newly created address in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['nullable', 'string', 'max:50'],
            'recipient_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'address_line' => ['required', 'string'],
            'village' => ['nullable', 'string', 'max:100'],
            'district' => ['nullable', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:10'],
            'notes' => ['nullable', 'string', 'max:255'],
            'is_default' => ['sometimes', 'boolean'],
            'redirect_to' => ['nullable', 'string'],
        ]);

        $user = $request->user();
        $isFirst = $user->addresses()->count() === 0;
        $isDefault = $isFirst || $request->boolean('is_default');

        DB::transaction(function () use ($user, $validated, $isDefault) {
            if ($isDefault) {
                $user->addresses()->update(['is_default' => false]);
            }

            $validated['is_default'] = $isDefault;
            $user->addresses()->create($validated);
        });

        if ($request->filled('redirect_to')) {
            return redirect($request->input('redirect_to'))
                ->with('success', 'Alamat baru berhasil ditambahkan.');
        }

        return redirect()->route('addresses.index')
            ->with('success', 'Alamat baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified address.
     */
    public function edit(Address $address): View
    {
        $this->authorizeAddress($address);

        return view('addresses.edit', compact('address'));
    }

    /**
     * Update the specified address in storage.
     */
    public function update(Request $request, Address $address): RedirectResponse
    {
        $this->authorizeAddress($address);

        $validated = $request->validate([
            'label' => ['nullable', 'string', 'max:50'],
            'recipient_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'address_line' => ['required', 'string'],
            'village' => ['nullable', 'string', 'max:100'],
            'district' => ['nullable', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:10'],
            'notes' => ['nullable', 'string', 'max:255'],
            'is_default' => ['sometimes', 'boolean'],
        ]);

        $user = $request->user();
        $isDefault = $request->boolean('is_default');

        DB::transaction(function () use ($user, $address, $validated, $isDefault) {
            if ($isDefault) {
                $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
                $validated['is_default'] = true;
            } elseif ($address->is_default && $user->addresses()->count() === 1) {
                // If only one address, keep it default
                $validated['is_default'] = true;
            }

            $address->update($validated);
        });

        return redirect()->route('addresses.index')
            ->with('success', 'Alamat berhasil diperbarui.');
    }

    /**
     * Remove the specified address from storage.
     */
    public function destroy(Address $address): RedirectResponse
    {
        $this->authorizeAddress($address);

        $user = Auth::user();

        DB::transaction(function () use ($user, $address) {
            $wasDefault = $address->is_default;
            $address->delete();

            if ($wasDefault) {
                // Assign new default if other addresses exist
                $nextAddress = $user->addresses()->first();
                if ($nextAddress) {
                    $nextAddress->update(['is_default' => true]);
                }
            }
        });

        return redirect()->route('addresses.index')
            ->with('success', 'Alamat berhasil dihapus.');
    }

    /**
     * Set the specified address as default for the customer.
     */
    public function setDefault(Address $address): RedirectResponse
    {
        $this->authorizeAddress($address);

        DB::transaction(function () use ($address) {
            Auth::user()->addresses()->update(['is_default' => false]);
            $address->update(['is_default' => true]);
        });

        return back()->with('success', 'Alamat utama berhasil diubah.');
    }

    /**
     * Ensure the authenticated user owns the given address.
     */
    protected function authorizeAddress(Address $address): void
    {
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses ke alamat ini.');
        }
    }
}
