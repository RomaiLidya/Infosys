<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PurchaseInvoice', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceNumber', 32);
            $table->string('invoiceNumberSupplier', 32);
            $table->integer('PartnerId');
            $table->integer('PurchaseOrderId');
            $table->date('orderDate');
            $table->date('dueDate');
            $table->date('paidDate')->nullable();
            $table->integer('totalItem')->default(0);
            $table->integer('totalPrice')->default(0);
            $table->integer('totalDiscount')->default(0);
            $table->integer('totalPay')->default(0);
            $table->enum('statusPayment', ['PAID', 'UNPAID'])->default('UNPAID');
            $table->boolean('inStock')->default(false);
            $table->integer('logisticPrice')->default(0);
            $table->text('notes')->nullable();  
            $table->text('terms')->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('PartnerId', 'Partner')->references('id')->on('Partner')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('PurchaseOrderId', 'PurchaseOrder')->references('id')->on('PurchaseOrder')->onDelete('CASCADE')->onUpdate('CASCADE');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PurchaseInvoice');
    }
}
