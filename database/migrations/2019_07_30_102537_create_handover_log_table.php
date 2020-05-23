<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandoverLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handover_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('handover_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->string('request_ref')->nullable();
            $table->date('handover_date');
            $table->integer('request_emp')->unsigned();
            $table->integer('approved_emp')->unsigned();
            $table->integer('handovered_emp')->unsigned();
            $table->text('file_path')->nullable();
            $table->string('operation');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('handover_log');
    }
}
