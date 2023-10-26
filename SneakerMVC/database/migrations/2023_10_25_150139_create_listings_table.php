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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("sneaker_id");
            $table->foreign('sneaker_id')->references('id')->on('sneakers');
            $table->string('listing_title');
            $table->string('listing_description');
            $table->string('listing_price');
            $table->string('listing_originalprice');
            $table->boolean('listing_sold')->default(false);
            $table->integer('buyer_id')->nullable();
            $table->integer("seller_id");
            $table->boolean("listing_active")->default(true);
            $table->boolean("listing_approved")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
