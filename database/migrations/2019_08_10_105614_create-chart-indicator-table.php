<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartIndicatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_indicator', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chart_id')->unsigned();
            $table->integer('indicator_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('chart_indicator', function($table) {
            $table->foreign('chart_id')->references('id')->on('chart');
            $table->foreign('indicator_id')->references('id')->on('indicator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chart_indicator');
    }
}
