<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIndicator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicator', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->string('unit_label');
            $table->integer('indicator_parent_id')->nullable()->unsigned();
            $table->boolean('is_parent')->index();
            $table->string('tag')->nullable();
            $table->timestamps();
        });

        Schema::table('indicator', function (Blueprint $table) {
            $table->foreign('indicator_parent_id')->references('id')->on('indicator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicator');
    }
}
