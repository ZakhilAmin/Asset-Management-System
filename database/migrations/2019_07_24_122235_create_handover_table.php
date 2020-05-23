<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandoverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handover', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id')->unsigned();
            $table->string('request_ref')->nullable();
            $table->date('handover_date');
            $table->integer('request_emp')->unsigned();
            $table->integer('approved_emp')->unsigned();
            $table->integer('handovered_emp')->unsigned();
            $table->text('file_path')->nullable();
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
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
        Schema::dropIfExists('handover');
        Schema::table('handover', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
