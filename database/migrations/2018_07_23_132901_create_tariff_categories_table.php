<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTariffCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariff_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->string('title_uk');
            $table->text('description_ru');
            $table->text('description_uk');
            $table->string('alias');
            $table->tinyInteger('published');
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
        Schema::dropIfExists('tariff_categories');
    }
}
