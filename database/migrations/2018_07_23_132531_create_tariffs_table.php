<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tariff_category_id');
            $table->string('title_ru');
            $table->string('sub_title_first_ru')->nullable();
            $table->string('sub_title_second_ru')->nullable();
            $table->text('description_ru');
            $table->string('title_uk');
            $table->string('sub_title_first_uk')->nullable();
            $table->string('sub_title_second_uk')->nullable();
            $table->text('description_uk');
            $table->string('rate')->nullable();
            $table->string('term_ru')->nullable();
            $table->string('term_uk')->nullable();
            $table->tinyInteger('published')->default(1);
            $table->string('image')->nullable();
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
        Schema::dropIfExists('tariffs');
    }
}
