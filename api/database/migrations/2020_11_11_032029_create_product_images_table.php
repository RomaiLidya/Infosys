<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProductImages', function (Blueprint $table) {
            $table->id();
            $table->string('path', 128); 
            $table->integer('ProductId');
            $table->timestamp('createdAt')->nullable(); 
            $table->timestamp('updatedAt')->nullable();
            $table->foreign('ProductId', 'ProductImages')->references('id')->on('Product')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ProductImages');
    }
}
