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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('fullName');
            $table->date('birth');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // --- KOLOM BARU DITAMBAHKAN DI SINI ---
            // Kolom untuk menyimpan path ke foto profil pengguna.
            // Dibuat nullable karena foto profil bersifat opsional.
            $table->string('profile_photo_path', 2048)->nullable();
            // -----------------------------------------

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
