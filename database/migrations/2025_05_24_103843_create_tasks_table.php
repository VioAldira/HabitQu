<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // File: database/migrations/xxxx_create_tasks_table.php

public function up(): void
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        // BARIS INI WAJIB ADA untuk relasi ke tabel 'lists'
        $table->foreignId('list_id')->constrained()->onDelete('cascade');
        
        $table->string('title');
        $table->text('description')->nullable();
        $table->boolean('is_completed')->default(false);
        $table->date('due_date')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
