<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('InvoicePayment', function (Blueprint $table) {
            $table->id();
            $table->string('paymentNumber');
            $table->integer('InvoiceId');
            $table->integer('BankId')->nullable();
            $table->integer('SalesId')->nullable();
            $table->integer('totalPay')->default(0);
            $table->date('payDate');
            $table->enum('paymentMethod', ['CASH', 'Bank Transfer', 'Digital Payment', 'Giro'])->nullable();
            $table->text('note')->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('InvoiceId', 'Invoice')->references('id')->on('Invoice')->onDelete('CASCADE')->onDelete('CASCADE');
            $table->foreign('BankId', 'Bank')->references('id')->on('Bank')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('InvoicePayment');
    }
}
