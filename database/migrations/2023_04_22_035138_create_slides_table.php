<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->string('photo');
            $table->boolean('active')->default(true);
            // to active or deactive the slide
            $table->timestamps();

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // OR U CAN USE THIS METHOD ONLY
            // $table->foreignID('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
