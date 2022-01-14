<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LogActivity', function (Blueprint $table) {
            $table->id();
            $table->string('action')->nullable();
            $table->text('description')->nullable();
            $table->json('oldValue')->nullable();
            $table->json('newValue')->nullable();
            $table->integer('createdBy');
            $table->timestamp('createdAt');
            $table->foreign('createdBy', 'User')->references('id')->on('User')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

   /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('LogActivity');
    }
}
