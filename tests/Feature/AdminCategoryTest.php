<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_list_categories(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create(['name' => 'Pashmina']);

        $response = $this->actingAs($admin)->get(route('admin.categories.index'));

        $response->assertStatus(200);
        $response->assertSee('Pashmina');
        $response->assertSee('Daftar Kategori');
    }

    public function test_admin_can_create_category_with_auto_slug(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('admin.categories.store'), [
            'name' => 'Hijab Instan',
            'slug' => '',
            'description' => 'Kategori hijab instan praktis',
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Hijab Instan',
            'slug' => 'hijab-instan',
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_category(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create([
            'name' => 'Voal Lama',
            'slug' => 'voal-lama',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.categories.update', $category), [
            'name' => 'Voal Premium',
            'slug' => 'voal-premium',
            'description' => 'Deskripsi baru',
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Voal Premium',
            'slug' => 'voal-premium',
        ]);
    }

    public function test_category_cannot_be_its_own_parent(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->put(route('admin.categories.update', $category), [
            'name' => $category->name,
            'slug' => $category->slug,
            'parent_id' => $category->id,
        ]);

        $response->assertSessionHasErrors(['parent_id']);
    }

    public function test_admin_can_delete_category(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.categories.destroy', $category));

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }

    public function test_customer_cannot_access_admin_category_pages(): void
    {
        $customer = User::factory()->customer()->create();

        $response = $this->actingAs($customer)->get(route('admin.categories.index'));
        $response->assertStatus(403);

        $response = $this->actingAs($customer)->get(route('admin.categories.create'));
        $response->assertStatus(403);
    }
}
