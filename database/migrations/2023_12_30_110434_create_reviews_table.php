<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->text('review');
            $table->unsignedTinyInteger('rating'); //unsignedTinyInteger holds value from 0 to 255
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade'); //shorte syntax
            // $table->unsignedBigInteger('book_id');
            // $table->foreign('book_id')->references('books')->on('id')->onDelete('cascade'); longer syntax more flexibe
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
