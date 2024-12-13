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
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // id buku
            $table->unsignedBigInteger('user_id')->nullable(); // id pengguna yang terkait (opsional)
            $table->string('title', 255); // judul buku
            $table->string('author', 225); // penulis buku
            $table->text('description')->nullable(); // deskripsi buku
            $table->enum('status', ['Tersedia', 'Tidak_Tersedia'])->default('Tersedia'); // status buku
            $table->timestamps(); // created_at dan updated_at
            $table->unsignedBigInteger('category_id')->nullable(); // id kategori yang terkait (opsional)
        
            // Relasi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};