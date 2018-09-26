<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->string('title_uk');
            $table->string('alias');
            $table->text('description_ru');
            $table->text('description_uk');
            $table->integer('region_id');
            $table->integer('city_id');
            $table->string('photo');
            $table->string('wide_photo');
            $table->string('link_title')->nullable();
            $table->string('link')->nullable();
            $table->date('start_at');
            $table->date('finish_at');
            $table->tinyInteger('published')->default(1);
            $table->string('type')->default('actions');
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
        Schema::dropIfExists('actions');
    }
}
