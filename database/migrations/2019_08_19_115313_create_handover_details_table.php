<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandoverDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handover_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('handover_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('tag_no')->nullable();
            $table->decimal('quantity',5,2);
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('handover_details');
    }
}
