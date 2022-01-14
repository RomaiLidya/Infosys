<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('InvoiceDate', function (Blueprint $table) {
            $table->id();
            $table->integer('InvoiceId');
            $table->date('dueDate');
            $table->date('paidDate')->nullable();
            $table->boolean('isCurrent')->default(true);
            $table->integer('updatedBy');
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->foreign('InvoiceId', 'Invoice')->references('id')->on('Invoice')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('updatedBy', 'User')->references('id')->on('User')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('InvoiceDate');
    }
}
