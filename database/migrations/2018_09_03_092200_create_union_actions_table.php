<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnionActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('union_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('action_id');
            $table->unsignedInteger('city_id');
            $table->foreign('action_id')->references('id')->on('actions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('union_actions');
    }
}
