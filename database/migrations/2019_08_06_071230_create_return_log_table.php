<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('return_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->date('return_date');
            $table->string('tag_no');
            $table->integer('employee_id')->unsigned();
            $table->string('class_id');
            $table->string('status_id');
            $table->string('returned_emp');
            $table->decimal('quantity',5,2);
            $table->string('operation');
            $table->integer('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_log');
    }
}
