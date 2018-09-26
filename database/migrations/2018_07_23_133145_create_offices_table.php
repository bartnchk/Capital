<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->unsignedInteger('region_id');
            $table->unsignedInteger('city_id');
            $table->string('address_ru', 255);
            $table->string('address_uk', 255);
            $table->string('phone', 15)->nullable();
            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();
            $table->float('lat', 30)->nullable();
            $table->float('lng', 30)->nullable();
            $table->string('meta_title_ru', 255)->nullable();
            $table->string('meta_title_uk', 255)->nullable();
            $table->text('meta_description_uk')->nullable();
            $table->text('meta_description_ru')->nullable();
            $table->text('meta_keywords_ru')->nullable();
            $table->text('meta_keywords_uk')->nullable();
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
        Schema::dropIfExists('offices');
    }
}
