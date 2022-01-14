<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProductItem', function (Blueprint $table) {
            $table->id();
            $table->integer('ProductPackageId');
            $table->integer('ProductId');
            $table->integer('minimumItem')->nullable()->default(0);
            $table->integer('bonusItem')->nullable()->default(0);
            $table->integer('promoPrice')->default(0);
            $table->boolean('isDeleted')->default(false);
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();
            $table->foreign('ProductPackageId', 'ProductPackage')->references('id')->on('ProductPackage')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('ProductId', 'Product')->references('id')->on('Product')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ProductItem');
    }
}
