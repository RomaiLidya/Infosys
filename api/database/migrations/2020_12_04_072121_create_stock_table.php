<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Stock', function (Blueprint $table) {
            $table->id();
            $table->integer('WareHouseId');
            $table->date('enterDate');
            $table->string('purchasesNumber', 128)->nullable();
            $table->integer('totalPrice')->default(0);
            $table->integer('totalItem')->default(0);
            $table->text('description')->nullable();
            $table->integer('createdBy');
            $table->integer('PartnerId');
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('WareHouseId', 'WareHouse')->references('id')->on('WareHouse')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('createdBy', 'User')->references('id')->on('User')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('PartnerId', 'Partner')->references('id')->on('Partner')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Stock');
    }
}
