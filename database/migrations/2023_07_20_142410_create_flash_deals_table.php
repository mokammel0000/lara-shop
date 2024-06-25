<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('flash_deals', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->integer('discount_percentage');
            $table->decimal('original_price');
            $table->decimal('discounted_price');

            $table->integer('duration');
            $table->dateTime('start_at');
            $table->dateTime('end_at');


            $table->boolean('active')->default(true);
            $table->string('photo_path');

            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flash_deals');
    }
};
