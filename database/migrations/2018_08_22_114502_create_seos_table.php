<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('alias');
            $table->string('meta_title_ru')->nullable();
            $table->string('meta_title_uk')->nullable();
            $table->text('meta_description_ru')->nullable();
            $table->text('meta_description_uk')->nullable();
            $table->text('meta_keywords_uk')->nullable();
            $table->text('meta_keywords_ru')->nullable();
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
        Schema::dropIfExists('seos');
    }
}
