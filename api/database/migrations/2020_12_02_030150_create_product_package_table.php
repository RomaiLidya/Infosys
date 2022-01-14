<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProductPackage', function (Blueprint $table) {
            $table->id();
            $table->integer('ProductId');
            $table->string('name');
            $table->integer('totalPrice')->default(0);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->integer('ZoneId');
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('ProductId', 'Product')->references('id')->on('Product')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('ZoneId','Zone')->references('id')->on('Zone')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ProductPackage');
    }
}
