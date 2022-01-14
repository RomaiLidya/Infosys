<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePieceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('InvoicePiece', function (Blueprint $table) {
            $table->id();
            $table->integer('InvoiceId');
            $table->integer('InvoiceReturnId')->nullable();
            $table->integer('price')->default(0);
            $table->enum('type', ['SHIPPING', 'ROUNDING', 'RETURN', 'OTHER'])->nullable();
            $table->text('note')->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('InvoiceId', 'Invoice')->references('id')->on('Invoice')->onDelete('CASCADE')->onDelete('CASCADE');
            $table->foreign('InvoiceReturnId', 'InvoiceReturn')->references('id')->on('InvoiceReturn')->onDelete('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('InvoicePiece');
    }
}
