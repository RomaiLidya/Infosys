<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockCheckItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StockCheckItem', function (Blueprint $table) {
            $table->id();
            $table->integer('ProductId');
            $table->integer('StockCheckId');
            $table->enum('typeUnit', ['Unit', 'Buah', 'Pasang', 'Lembar', 'Keping', 'Batang', 'Bungkus', 'Butir', 'Roll', 'Dus', 'Pcs', 'Set'])->nullable();
            $table->enum('status', ['CONFIRM', 'PENDING', 'CANCEL']);
            $table->boolean('isMerge')->default(false);
            $table->integer('purchasePrice')->default(0);
            $table->integer('currentItem')->default(0);
            $table->integer('totalItem')->default(0);
            $table->integer('returnItem')->default(0);
            $table->integer('damagedItem')->default(0);
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('ProductId', 'Product')->references('id')->on('Product')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('StockCheckId', 'StockCheck')->references('id')->on('StockCheck')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('StockCheckItem');
    }
}
