<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StockItem', function (Blueprint $table) {
            $table->id();
            $table->integer('ProductId');
            $table->integer('StockId');
            $table->integer('WareHouseId')->nullable();
            $table->enum('typeUnit', ['Unit', 'Buah', 'Pasang', 'Lembar', 'Keping', 'Batang', 'Bungkus', 'Butir', 'Roll', 'Dus', 'Paket', 'Pcs', 'Set'])->nullable();
            $table->integer('purchasePrice')->default(0);
            $table->integer('totalPrice')->default(0);
            $table->integer('totalItem')->default(0);
            $table->integer('logisticPrice')->default(0);
            $table->integer('unitNetPrice')->default(0);
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('ProductId', 'Product')->references('id')->on('Product')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('StockId', 'Stock')->references('id')->on('Stock')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('WareHouseId', 'WareHouse')->references('id')->on('WareHouse')->onDelete('CASCADE')->onUpdate('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('StockItem');
    }
}
