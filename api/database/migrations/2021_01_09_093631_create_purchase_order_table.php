<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PurchaseOrder', function (Blueprint $table) {
            $table->id();
            $table->string('orderNumber', 32);
            $table->integer('PartnerId');
            $table->date('orderDate');
            $table->date('dueDate');
            $table->integer('totalItem')->default(0);
            $table->integer('totalPrice')->default(0);
            $table->integer('totalDiscount')->default(0);
            $table->enum('statusOrder', ['CONFIRMATION', 'PENDING', 'CANCEL', 'REJECT'])->default('PENDING');
            $table->text('notes')->nullable();
            $table->text('terms')->nullable();
            $table->string('signaturePath')->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
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
        Schema::dropIfExists('PurchaseOrder');
    }
}
