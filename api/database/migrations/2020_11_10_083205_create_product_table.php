<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Product', function (Blueprint $table) {
            $table->id();
            $table->string('productName', 128);
            $table->string('productCode', 32);
            $table->integer('purchasePrice')->default(0)->nullable();
            $table->integer('sellingPrice')->default(0)->nullable();
            $table->integer('CategoryId');
            $table->text('description')->nullable();
            $table->enum('typeUnit', ['Unit', 'Buah', 'Pasang', 'Lembar', 'Keping', 'Batang', 'Bungkus', 'Butir', 'Roll', 'Dus', 'Paket', 'Pcs', 'Set'])->nullable();
            $table->integer('totalStock')->default(0);
            $table->integer('minimumStock')->default(0);
            $table->integer('holdItem')->default(0);
            $table->boolean('isReminder')->default(false)->nullable();
            $table->boolean('isDeleted')->default(false)->nullable();
            $table->boolean('isProductPackage')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('CategoryId', 'Category')->references('id')->on('Category')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Product');
    }
}
