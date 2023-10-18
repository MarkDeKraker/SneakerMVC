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
        Schema::create('sneakers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users');
            $table->string("sneaker_brand");
            $table->string("sneaker_model");
            $table->string("sneaker_color");
            $table->string("sneaker_size");
            $table->string("sneaker_releasedate");
            $table->string("sneaker_stylecode");
            $table->string("sneaker_paidprice");
            $table->binary("sneaker_picture");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sneakers');
    }
};
