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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Relasi ke tabel categories (Satu produk hanya punya satu kategori)
            $table->foreignUuid('category_id')->constrained('categories')->onDelete('cascade');

            $table->string('name');
            $table->string('slug')->unique();

            // Deskripsi lengkap produk
            $table->longText('description')->nullable();

            // Harga produk menggunakan tipe data decimal untuk akurasi keuangan
            $table->decimal('price', 15, 2);

            // Jumlah stok yang tersedia
            $table->unsignedInteger('stock')->default(0);

            // Path ke gambar utama produk
            $table->string('image_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
