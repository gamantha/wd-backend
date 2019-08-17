<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('report_template_id')->unsigned();
            $table->dateTime('report_date');
            $table->string('author_id')->index();
            $table->integer('status')->index();
            $table->timestamps();
        });

        Schema::table('report', function (Blueprint $table) {
            $table->foreign('report_template_id')->references('id')->on('report_template');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report');
    }
}
