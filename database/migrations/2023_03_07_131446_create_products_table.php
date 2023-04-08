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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');                  //because it can be chars and numbers 
            $table->string('name');
            $table->longText('description');
            //$table->float('price');
            $table->double('price')->default(0);
            $table->bigInteger('stock')->default(0);
            $table->unsignedBigInteger('category_id');      //we put it biginteger because the id field is created biginteger automatically in laravel
                                                    // Until now we don't link the Products table with the Categories table

            $table->timestamps();

            //Foreign Key Constraints....to link the two tables
            $table->foreign('category_id')->references('id')->on('categories');
                                                                                //when a category is deleted delete it's childs(products)...

            // or u can use it directly 
            // $table->foreignId('user_id')->constrained();
            //it will create the foreign id with it's constrains

            //If u don't write the foregin key line, the relationship will be created successfully, but
            //there will cause some problems for you, so it's better to write it
            //when you put it, you can write any constrains you want....
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
