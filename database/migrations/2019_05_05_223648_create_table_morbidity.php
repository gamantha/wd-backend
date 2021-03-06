<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMorbidity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morbidity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cause');
            $table->string('gender')->index();
            $table->string('age');
            $table->integer('report_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('morbidity', function (Blueprint $table) {
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
        Schema::dropIfExists('morbidity');
    }
}
