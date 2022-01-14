<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Mutation', function (Blueprint $table) {
            $table->id();
            $table->string('mutationNumber');
            $table->date('mutationDate')->nullable();
            $table->enum('status', ['PENDING', 'PROCESS','ACCEPTED']);
            $table->tinyInteger('totalItem')->default(0);
            $table->tinyInteger('totalQuantity')->default(0);
            $table->integer('DestinationId');
            $table->integer('OriginId');
            $table->integer('mutationBy');
            $table->integer('acceptedBy')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('Mutation');
    }
}
