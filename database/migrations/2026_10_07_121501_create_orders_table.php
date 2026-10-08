<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 40)->unique();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->enum('status', [
                'pending',
                'confirmed',
                'processing',
                'packed',
                'shipped',
                'delivered',
                'completed',
                'cancelled',
            ])->default('pending')->index();
            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
                'expired',
                'refunded',
            ])->default('pending')->index();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('shipping_cost', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2);
            $table->string('voucher_code', 50)->nullable();
            $table->decimal('voucher_discount', 12, 2)->default(0);
            $table->string('shipping_recipient_name', 120);
            $table->string('shipping_phone', 30);
            $table->text('shipping_address');
            $table->string('shipping_city', 100);
            $table->string('shipping_province', 100);
            $table->string('shipping_postal_code', 10);
            $table->text('customer_note')->nullable();
            $table->timestamp('placed_at')->nullable();
            $table->timestamps();

            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
