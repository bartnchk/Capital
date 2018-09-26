<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->string('title_uk');
            $table->text('description_ru');
            $table->text('description_uk');
            $table->string('alias');
            $table->string('certificate')->nullable();
            $table->tinyInteger('published')->default(1);
            $table->string('meta_title_ru')->nullable();
            $table->text('meta_description_ru')->nullable();
            $table->text('meta_keywords_ru')->nullable();
            $table->string('meta_title_uk')->nullable();
            $table->text('meta_description_uk')->nullable();
            $table->text('meta_keywords_uk')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
