<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Role', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45)->nullable();
            $table->string('label', 45);
            $table->string('notes', 45)->nullable();
            $table->string('group_by', 45);
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
        Schema::dropIfExists('Role');
    }
}
