<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Invoice', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceNumber', 32);
            $table->integer('PartnerId');
            $table->integer('SalesId');
            $table->integer('SalesOrderId');
            $table->date('orderDate');
            $table->date('dueDate');
            $table->date('paymentDue')->nullable();
            $table->date('paidDate')->nullable();
            $table->integer('totalItem')->default(0);
            $table->integer('totalPrice')->default(0);
            $table->integer('totalDiscount')->default(0);
            $table->integer('totalPiece')->default(0);
            $table->integer('totalPay')->default(0);
            $table->enum('statusPayment', ['PAID', 'UNPAID'])->default('UNPAID');
            $table->enum('typeInvoice', ['GENERAL', 'ALLOWED'])->default('GENERAL');
            $table->text('notes')->nullable();
            $table->text('terms')->nullable();
            $table->integer('rounding')->default(0);
            $table->integer('originalPrice')->default(0);
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('PartnerId', 'Partner')->references('id')->on('Partner')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('SalesId', 'Sales')->references('id')->on('User')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('SalesOrderId', 'SalesOrder')->references('id')->on('SalesOrder')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Invoice');
    }
}
