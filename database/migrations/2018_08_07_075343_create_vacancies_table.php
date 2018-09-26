<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru', 500);
            $table->string('title_uk', 500);
            $table->text('description_ru');
            $table->text('description_uk');
            $table->string('salary', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('region_id');
            $table->unsignedInteger('city_id');
            $table->boolean('published')->default(true);
            $table->foreign('category_id')
                  ->references('id')->on('vacancy_categories')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('vacancies');
    }
}
