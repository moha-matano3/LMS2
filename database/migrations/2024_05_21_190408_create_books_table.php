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
            $table->id();
            $table->string('book_title');
            $table->string('book_img')->nullable();
            $table->string('desc');
            $table->string('author_name');
            $table->string('author_img')->nullable();
            $table->integer('price');
            $table->integer('quantity');
            $table->string('shelf_place');
<<<<<<< HEAD
            $table->string('publisher_name')->nullable();
            $table->integer('year')->nullable();
=======
            $table->string('publication')->nullable();
            $table->string('publisher_name')->nullable();
            $table->integer('year')->nullable();
            $table->string('editor')->nullable();
>>>>>>> 77892e75226f90fd3341628a54bbd19a90a7c50f
            $table->enum('pg_rating', ['PG', '18+', 'R'])->nullable();
            $table->foreignId('categories_id')->constrained()->onDelete('cascade');
            $table->timestamps();
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
