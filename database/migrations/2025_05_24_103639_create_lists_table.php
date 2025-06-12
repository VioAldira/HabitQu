<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_lists_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            // BARIS INI SANGAT PENTING:
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menambahkan kolom user_id dan foreign key ke tabel users
            $table->string('title'); // Anda juga memerlukan judul untuk list
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lists');
    }
};