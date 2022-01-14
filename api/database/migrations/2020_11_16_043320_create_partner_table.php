<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Partner', function (Blueprint $table) {
            $table->id();
            $table->string('partnerId')->unique();
            $table->string('name', 32);
            $table->string('phoneNumber', 13)->nullable();
            $table->string('cellPhoneNumber', 13)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->enum('businessEntity', ['PT', 'CV', 'Firma', 'Koperasi', 'Perorangan']);
            $table->enum('partnerType', ['SUPPLIER', 'CUSTOMER']);
            $table->string('virtualAccount')->nullable();
            $table->string('address');
            $table->string('areaCode', 13);
            $table->string('regionName', 100);
            $table->integer('postalCode')->nullable();
            $table->integer('ZoneId')->nullable();
            $table->integer('dueDate')->nullable();
            $table->integer('plafon')->nullable();
            $table->integer('totalBill')->default(0)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();            
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable(); 
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
        Schema::dropIfExists('Partner');
    }
}
