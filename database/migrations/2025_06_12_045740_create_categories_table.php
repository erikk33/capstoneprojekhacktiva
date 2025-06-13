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
        Schema::create('categories', function (Blueprint $table) {
            // Menggunakan UUID sebagai primary key
            $table->uuid('id')->primary();

            // Nama kategori, harus unik
            $table->string('name')->unique();

            // Slug untuk URL yang SEO-friendly (contoh: "pakaian-pria")
            $table->string('slug')->unique();

            // Deskripsi singkat tentang kategori
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
