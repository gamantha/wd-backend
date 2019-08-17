<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIndicatorValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicator_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('indicator_id')->unsigned();
            $table->string('value');
            $table->integer('report_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('indicator_value', function (Blueprint $table) {
            $table->foreign('indicator_id')->references('id')->on('indicator');
            $table->foreign('report_id')->references('id')->on('report');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicator_value');
    }
}
