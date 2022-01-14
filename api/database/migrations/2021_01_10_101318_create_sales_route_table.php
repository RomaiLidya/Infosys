<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SalesRoute', function (Blueprint $table) {
            $table->id();
            $table->integer('SalesId');
            $table->integer('ZoneId');
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('SalesId', 'User')->references('id')->on('User')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('ZoneId', 'Zone')->references('id')->on('Zone')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SalesRoute');
    }
}
