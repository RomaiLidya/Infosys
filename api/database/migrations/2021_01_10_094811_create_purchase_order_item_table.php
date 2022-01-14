<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PurchaseOrderItem', function (Blueprint $table) {
            $table->id();
            $table->integer('PurchaseOrderId');
            $table->integer('ProductId');
            $table->enum('typeUnit', ['Unit', 'Buah', 'Pasang', 'Lembar', 'Keping', 'Batang', 'Bungkus', 'Butir', 'Roll', 'Dus', 'Paket', 'Pcs', 'Set'])->nullable();
            $table->integer('price')->default(0);
            $table->integer('totalItem')->default(0);
            $table->integer('subTotalPrice')->default(0);
            $table->integer('totalPrice')->default(0);
            $table->integer('discount')->default(0);
            $table->enum('status', ['CONFIRM', 'PENDING', 'REJECT'])->default('PENDING');
            $table->text('notes')->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('PurchaseOrderId', 'PurchaseOrder')->references('id')->on('PurchaseOrder')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('ProductId', 'Product')->references('id')->on('Product')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PurchaseOrderItem');
    }
}
