<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportIndicatorMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_indicator_map', function (Blueprint $table) {
            $table->integer('indicator_id')->unsigned();
            $table->integer('report_template_id')->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->integer('order');
            $table->timestamps();
        });
        
        Schema::table('report_indicator_map', function (Blueprint $table) {
            $table->foreign('indicator_id')->references('id')->on('indicator');
            $table->foreign('report_template_id')->references('id')->on('report_template');
            $table->foreign('category_id')->references('id')->on('indicator_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_indicator_map');
    }
}
