<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',500);
            $table->string('alias',500);
            $table->integer('cate_id');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('reduce');
            $table->string('size',50)->nullable();
            $table->string('image',100);
            $table->string('sub_image',500)->nullable();
            $table->string('intro',500);
            $table->string('description',2000)->nullable();
            $table->integer('view')->default(0);
            $table->integer('status')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
