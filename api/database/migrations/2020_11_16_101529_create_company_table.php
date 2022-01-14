<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Company', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->string('phoneNumber', 13);
            $table->string('contactPerson', 32);
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('npwpNumber', 128);
            $table->string('cellPhoneNumber', 13)->nullable();
            $table->string('address');
            $table->string('areaCode', 13);
            $table->integer('postalCode');
            $table->string('image');
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Company');
    }
}
