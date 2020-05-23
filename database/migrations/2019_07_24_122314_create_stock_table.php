<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial_no')->unique();
            $table->integer('product_id')->unsigned();
            $table->string('tag_no')->unique();
            $table->double('cost',15,8);
            $table->date('contract_date')->nullable();
            $table->date('receive_date')->nullable();
            $table->integer('class_id');
            $table->string('m7')->nullable();
            $table->string('m16')->nullable();
            $table->string('unit_id');
            $table->decimal('quantity',5,2);
            $table->integer('status_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('donar_id');
            $table->string('location_id');
            $table->string('expected_life')->nullable();
            $table->text('description')->nullable();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock');
        Schema::table('stock', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
