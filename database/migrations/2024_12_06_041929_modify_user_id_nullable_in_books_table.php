<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserIdNullableInBooksTable extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            // Mengubah user_id menjadi nullable di tabel books
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            // Mengembalikan user_id menjadi non-nullable di tabel books
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
}