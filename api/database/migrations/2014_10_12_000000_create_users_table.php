<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('User', function (Blueprint $table) {
            $table->id();
            $table->string('firstName', 32);
            $table->string('lastName', 32)->nullable();
            $table->string('contactNumber', 20)->nullable();
            $table->string('loginName')->nullable();
            $table->string('email')->unique();
            $table->boolean('isActive')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('pin')->nullable();
            $table->rememberToken();
            $table->integer('roleId')->unsigned()->nullable();
            $table->enum('typeUser', ['ADMIN', 'SALES', 'SUPERADMIN', 'ADMINWAREHOUSE'])->nullable();
            $table->boolean('isNew')->default(true);
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('User');
    }
}
