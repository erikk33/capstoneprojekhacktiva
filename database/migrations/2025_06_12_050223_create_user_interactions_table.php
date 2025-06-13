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
        Schema::create('user_interactions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Pengguna yang melakukan interaksi
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');

            // Tipe interaksi (misalnya: melihat produk, menambah ke keranjang, membeli)
            $table->string('interaction_type'); // Contoh: 'view_product', 'view_category', 'add_to_cart', 'purchase'

            // ID dari item yang berinteraksi dengannya. Dibuat nullable karena tidak semua interaksi terkait dengan satu entitas spesifik.
            // Contoh: interaksi 'view_category' hanya butuh category_id.
            $table->uuid('product_id')->nullable();
            $table->uuid('category_id')->nullable();

            // Tambahkan foreign key constraint secara manual untuk kolom nullable
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_interactions');
    }
};
