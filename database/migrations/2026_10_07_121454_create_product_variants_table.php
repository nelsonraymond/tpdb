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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name', 120);
            $table->string('sku', 80)->unique();
            $table->string('color_name', 80)->nullable()->index();
            $table->string('color_hex', 20)->nullable();
            $table->string('size', 50)->nullable();
            $table->decimal('additional_price', 12, 2)->default(0);
            $table->unsignedInteger('stock_qty')->default(0)->index();
            $table->unsignedInteger('low_stock_threshold')->default(5);
            $table->unsignedInteger('weight_gram')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
