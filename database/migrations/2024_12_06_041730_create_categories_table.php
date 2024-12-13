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
            $table->bigIncrements('id'); // AUTO_INCREMENT PRIMARY KEY
            $table->string('name', 255); // Kolom name
            $table->text('description')->nullable(); // Kolom description
            $table->timestamps(); // Kolom created_at dan updated_at
        });

        // Menambahkan foreign key di tabel books (atau tasks sesuai konteks Anda)
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable(); // Tambahkan kolom foreign key
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Relasi dan cascade
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