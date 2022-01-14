<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserProfileRole', function (Blueprint $table) {
            $table->id();
            $table->integer('roleId');
            $table->integer('UserId');
            $table->foreign('roleId', 'Role')->references('id')->on('Role')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('UserId', 'User')->references('id')->on('User')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UserProfileRole');
    }
}
