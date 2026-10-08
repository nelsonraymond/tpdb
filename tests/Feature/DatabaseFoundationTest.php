<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DatabaseFoundationTest extends TestCase
{
    use RefreshDatabase;

    public function test_key_database_tables_exist(): void
    {
        $tables = [
            'users',
            'categories',
            'products',
            'product_variants',
            'orders',
            'order_items',
            'reviews',
        ];

        foreach ($tables as $table) {
            $this->assertTrue(Schema::hasTable($table), "Expected table [{$table}] to exist in the database.");
        }
    }

    public function test_all_foundation_tables_exist(): void
    {
        $tables = [
            'product_images',
            'inventory_movements',
            'carts',
            'cart_items',
            'wishlists',
            'addresses',
            'payments',
            'shipments',
            'vouchers',
            'voucher_usages',
            'banners',
            'notifications',
            'product_views',
        ];

        foreach ($tables as $table) {
            $this->assertTrue(Schema::hasTable($table), "Expected table [{$table}] to exist in the database.");
        }
    }

    public function test_users_table_has_role_and_phone_columns(): void
    {
        $this->assertTrue(Schema::hasColumn('users', 'role'), 'Expected [role] column on users table.');
        $this->assertTrue(Schema::hasColumn('users', 'phone'), 'Expected [phone] column on users table.');
    }
}
