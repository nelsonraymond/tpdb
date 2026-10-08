<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function createVariant(int $stock = 10, float $basePrice = 50000, float $addPrice = 0): ProductVariant
    {
        $category = Category::factory()->create(['is_active' => true]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'base_price' => $basePrice,
            'is_active' => true,
        ]);

        return ProductVariant::factory()->create([
            'product_id' => $product->id,
            'additional_price' => $addPrice,
            'stock_qty' => $stock,
            'is_active' => true,
        ]);
    }

    public function test_guest_can_add_item_to_cart(): void
    {
        $variant = $this->createVariant(stock: 15);

        $response = $this->post(route('cart.items.store'), [
            'product_variant_id' => $variant->id,
            'quantity' => 2,
        ]);

        $response->assertRedirect(route('cart.index'));

        $this->assertDatabaseHas('cart_items', [
            'product_variant_id' => $variant->id,
            'quantity' => 2,
        ]);
    }

    public function test_authenticated_customer_can_add_item_to_cart(): void
    {
        $customer = User::factory()->customer()->create();
        $variant = $this->createVariant(stock: 10);

        $response = $this->actingAs($customer)->post(route('cart.items.store'), [
            'product_variant_id' => $variant->id,
            'quantity' => 3,
        ]);

        $response->assertRedirect(route('cart.index'));

        $this->assertDatabaseHas('carts', [
            'user_id' => $customer->id,
        ]);

        $this->assertDatabaseHas('cart_items', [
            'product_variant_id' => $variant->id,
            'quantity' => 3,
        ]);
    }

    public function test_same_variant_merges_quantity(): void
    {
        $customer = User::factory()->customer()->create();
        $variant = $this->createVariant(stock: 10);

        $this->actingAs($customer)->post(route('cart.items.store'), [
            'product_variant_id' => $variant->id,
            'quantity' => 2,
        ]);

        $this->actingAs($customer)->post(route('cart.items.store'), [
            'product_variant_id' => $variant->id,
            'quantity' => 3,
        ]);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertNotNull($cart);
        $this->assertCount(1, $cart->items);
        $this->assertEquals(5, $cart->items->first()->quantity);
    }

    public function test_quantity_cannot_exceed_available_stock(): void
    {
        $customer = User::factory()->customer()->create();
        $variant = $this->createVariant(stock: 5);

        $response = $this->actingAs($customer)->post(route('cart.items.store'), [
            'product_variant_id' => $variant->id,
            'quantity' => 6,
        ]);

        $response->assertSessionHasErrors(['quantity']);
    }

    public function test_quantity_can_be_updated(): void
    {
        $customer = User::factory()->customer()->create();
        $variant = $this->createVariant(stock: 10);

        $this->actingAs($customer)->post(route('cart.items.store'), [
            'product_variant_id' => $variant->id,
            'quantity' => 2,
        ]);

        $cartItem = CartItem::first();

        $response = $this->actingAs($customer)->patch(route('cart.items.update', $cartItem), [
            'quantity' => 5,
        ]);

        $response->assertRedirect(route('cart.index'));
        $this->assertEquals(5, $cartItem->fresh()->quantity);
    }

    public function test_item_can_be_removed(): void
    {
        $customer = User::factory()->customer()->create();
        $variant = $this->createVariant();

        $this->actingAs($customer)->post(route('cart.items.store'), [
            'product_variant_id' => $variant->id,
            'quantity' => 1,
        ]);

        $cartItem = CartItem::first();

        $response = $this->actingAs($customer)->delete(route('cart.items.destroy', $cartItem));

        $response->assertRedirect(route('cart.index'));
        $this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
    }

    public function test_cart_subtotal_is_calculated_correctly_server_side(): void
    {
        $customer = User::factory()->customer()->create();
        $variant1 = $this->createVariant(stock: 10, basePrice: 60000, addPrice: 15000); // 75,000
        $variant2 = $this->createVariant(stock: 10, basePrice: 50000, addPrice: 0);     // 50,000

        $this->actingAs($customer)->post(route('cart.items.store'), [
            'product_variant_id' => $variant1->id,
            'quantity' => 2, // 150,000
        ]);

        $this->actingAs($customer)->post(route('cart.items.store'), [
            'product_variant_id' => $variant2->id,
            'quantity' => 1, // 50,000
        ]);

        $cart = Cart::where('user_id', $customer->id)->first();
        $this->assertEquals(200000, $cart->subtotal());

        $response = $this->actingAs($customer)->get(route('cart.index'));
        $response->assertStatus(200);
        $response->assertSee('200.000');
    }

    public function test_unauthorized_cart_access_is_blocked(): void
    {
        $customerA = User::factory()->customer()->create();
        $customerB = User::factory()->customer()->create();
        $variant = $this->createVariant();

        $this->actingAs($customerA)->post(route('cart.items.store'), [
            'product_variant_id' => $variant->id,
            'quantity' => 1,
        ]);

        $itemA = CartItem::first();

        // Customer B tries to update Customer A's item
        $response = $this->actingAs($customerB)->patch(route('cart.items.update', $itemA), [
            'quantity' => 3,
        ]);
        $response->assertStatus(403);

        // Customer B tries to delete Customer A's item
        $response = $this->actingAs($customerB)->delete(route('cart.items.destroy', $itemA));
        $response->assertStatus(403);
    }

    public function test_guest_cart_merges_into_customer_cart_after_login(): void
    {
        $customer = User::factory()->customer()->create([
            'email' => 'member@example.com',
            'password' => Hash::make('password123'),
        ]);

        $variantGuest = $this->createVariant(stock: 10);
        $variantCustomer = $this->createVariant(stock: 10);

        // 1. Customer already has an item in their cart
        $userCart = Cart::create(['user_id' => $customer->id]);
        $userCart->items()->create([
            'product_variant_id' => $variantCustomer->id,
            'quantity' => 1,
            'unit_price' => $variantCustomer->finalPrice(),
        ]);

        // 2. Guest adds an item to cart
        $this->post(route('cart.items.store'), [
            'product_variant_id' => $variantGuest->id,
            'quantity' => 2,
        ]);

        // 3. Guest logs in
        $response = $this->post(route('login.submit'), [
            'email' => 'member@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('home'));

        // 4. Verify Customer cart now has both items
        $userCart->refresh();
        $this->assertCount(2, $userCart->items);
        $this->assertEquals(3, $userCart->totalItems());
        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $userCart->id,
            'product_variant_id' => $variantGuest->id,
            'quantity' => 2,
        ]);
    }
}
