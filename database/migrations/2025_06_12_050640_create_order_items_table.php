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
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Relasi ke pesanan induk
            $table->foreignUuid('order_id')->constrained('orders')->onDelete('cascade');

            // Relasi ke produk yang dibeli
            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');

            // Jumlah item produk ini yang dibeli dalam pesanan tersebut
            $table->unsignedInteger('quantity');

            // Harga per item pada saat transaksi (untuk jaga-jaga jika harga produk berubah)
            $table->decimal('price', 15, 2);

            // Tidak perlu timestamps di sini karena sudah terwakili oleh timestamps di tabel orders
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
