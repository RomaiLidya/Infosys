<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StockCheck', function (Blueprint $table) {
            $table->id();
            $table->integer('WareHouseId');
            $table->date('checkDate');
            $table->integer('totalCurrent')->default(0);
            $table->integer('totalProduct')->default(0);
            $table->integer('totalItem')->default(0);
            $table->integer('totalReturn')->default(0);
            $table->integer('totalDamaged')->default(0);
            $table->enum('status', ['CONFIRM', 'PENDING', 'CANCEL'])->default('PENDING');
            $table->text('description')->nullable();
            $table->integer('createdBy');
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('WareHouseId', 'WareHouse')->references('id')->on('WareHouse')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('createdBy', 'User')->references('id')->on('User')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('StockCheck');
    }
}
