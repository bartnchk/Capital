<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainBailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_bail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->string('title_uk');
            $table->text('description_ru');
            $table->text('description_uk');
            $table->string('image')->nullable();
            $table->string('image_bw')->nullable();
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
        Schema::dropIfExists('main_bail');
    }
}
