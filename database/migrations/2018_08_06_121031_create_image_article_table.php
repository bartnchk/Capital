<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_article', function (Blueprint $table) {
            $table->unsignedInteger('image_id')->index();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->unsignedInteger('action_id')->index();
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
        Schema::dropIfExists('image_article');
    }
}
