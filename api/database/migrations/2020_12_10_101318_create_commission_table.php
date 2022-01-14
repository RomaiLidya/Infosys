<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Commission', function (Blueprint $table) {
            $table->id();
            $table->integer('SalesId');
            $table->string('month');
            $table->integer('monthNumber');
            $table->integer('year');
            $table->enum('statusCommission', ['PAID_OFF', 'IN_FULL_DUE']);
            $table->integer('totalInvoice')->default(0);
            $table->integer('totalBill')->default(0);
            $table->integer('totalCommission')->default(0);
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('SalesId', 'Sales')->references('id')->on('User')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Commission');
    }
}
