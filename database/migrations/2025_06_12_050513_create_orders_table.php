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
            $table->uuid('id')->primary();

            // Pengguna yang membuat pesanan
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');

            // Nomor invoice atau nomor pesanan yang unik
            $table->string('order_number')->unique();

            // Total harga dari semua item dalam pesanan
            $table->decimal('total_amount', 15, 2);

            // Status pesanan saat ini
            $table->string('status')->default('pending'); // Contoh: pending, processing, shipped, completed, cancelled

            $table->timestamps();
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
