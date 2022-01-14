<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProductPrice', function (Blueprint $table) {
            $table->id();
            $table->integer('price')->default(0);
            $table->integer('ZoneId');
            $table->integer('ProductId');
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('ZoneId', 'Zone')->references('id')->on('Zone')->onDelete('CASCADE')->onDelete('CASCADE');
            $table->foreign('ProductId', 'Product')->references('id')->on('Product')->onDelete('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ProductTable');
    }
}
