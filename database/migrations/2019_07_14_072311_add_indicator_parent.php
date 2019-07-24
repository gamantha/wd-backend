<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndicatorParent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicator', function (Blueprint $table) {
            $table->integer('indicator_parent_id')->nullable();
            $table->index(['indicator_parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indicator', function (Blueprint $table) {
            $table->dropColumn(['indicator_parent_id']);
        });
    }
}
