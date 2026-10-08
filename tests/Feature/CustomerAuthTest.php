<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CustomerAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_view_login_page(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertSee('Masuk');
    }

    public function test_customer_can_view_register_page(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertSee('Daftar Akun Baru');
    }

    public function test_customer_registration_succeeds(): void
    {
        $response = $this->post(route('register.submit'), [
            'name' => 'Alya Nurhaliza',
            'email' => 'alya@example.com',
            'phone' => '08123456789',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
        ]);

        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'email' => 'alya@example.com',
            'name' => 'Alya Nurhaliza',
            'phone' => '08123456789',
            'role' => 'customer',
        ]);

        $user = User::where('email', 'alya@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue($user->isCustomer());
        $this->assertFalse($user->isAdmin());
        $this->assertAuthenticatedAs($user);
    }

    public function test_duplicate_email_registration_is_rejected(): void
    {
        User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $response = $this->post(route('register.submit'), [
            'name' => 'Duplicate User',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    public function test_registration_validation_requires_password_confirmation(): void
    {
        $response = $this->post(route('register.submit'), [
            'name' => 'Test User',
            'email' => 'test_unconfirmed@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different_password',
        ]);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest();
    }

    public function test_customer_login_succeeds(): void
    {
        $user = User::factory()->customer()->create([
            'email' => 'customer@example.com',
            'password' => Hash::make('secret1234'),
        ]);

        $response = $this->post(route('login.submit'), [
            'email' => 'customer@example.com',
            'password' => 'secret1234',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_customer_login_is_rejected(): void
    {
        User::factory()->customer()->create([
            'email' => 'customer@example.com',
            'password' => Hash::make('correct_password'),
        ]);

        $response = $this->post(route('login.submit'), [
            'email' => 'customer@example.com',
            'password' => 'wrong_password',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    public function test_customer_logout_succeeds(): void
    {
        $user = User::factory()->customer()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('home'));
        $this->assertGuest();
    }

    public function test_protected_profile_requires_authentication(): void
    {
        $response = $this->get(route('profile'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_customer_can_access_profile(): void
    {
        $user = User::factory()->customer()->create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
        ]);

        $response = $this->actingAs($user)->get(route('profile'));

        $response->assertStatus(200);
        $response->assertSee('Siti Aminah');
        $response->assertSee('siti@example.com');
        $response->assertSee('customer');
    }
}
