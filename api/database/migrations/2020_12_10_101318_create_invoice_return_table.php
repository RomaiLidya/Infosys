<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceReturnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('InvoiceReturn', function (Blueprint $table) {
            $table->id();
            $table->string('returnNumber', 32);
            $table->date('returnDate')->nullable();
            $table->integer('PartnerId');
            $table->integer('SalesId');
            $table->integer('InvoiceId')->nullable();
            $table->integer('totalItem')->default(0);
            $table->integer('totalPrice')->default(0);
            $table->integer('totalDiscount')->default(0);
            $table->enum('typeReturn', ['SUPPLIER', 'CUSTOMER']);
            $table->boolean('usageStatus')->default(false)->nullable();
            $table->text('notes')->nullable();  
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('PartnerId', 'Partner')->references('id')->on('Partner')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('SalesId', 'Sales')->references('id')->on('User')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('InvoiceId', 'Invoice')->references('id')->on('Invoice')->onDelete('CASCADE')->onUpdate('CASCADE');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('InvoiceReturn');
    }
}
