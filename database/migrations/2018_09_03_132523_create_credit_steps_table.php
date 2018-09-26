<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->text('description_ru');
            $table->string('title_uk');
            $table->text('description_uk');
            $table->text('time_ru');
            $table->text('time_uk');
            $table->tinyInteger('published')->default(1);
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
        Schema::dropIfExists('credit_steps');
    }
}
