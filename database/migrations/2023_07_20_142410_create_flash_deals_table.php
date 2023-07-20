<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flash_deals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedtinyInteger('deal_percent')->nullable();
            $table->integer('duaration')->nullable();
            $table->boolean('active')->nullable()->default(true);
            $table->string('photo_path')->nullble();

            $table->unsignedBigInteger('product_id')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flash_deals');
    }
};
