<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->integer('theme_id')->unsigned();
            $table->timestamps();

            $table->foreign('question_id')
                    ->references('id')
                    ->on('questions');

            $table->foreign('theme_id')
                    ->references('id')
                    ->on('themes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_theme', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropForeign(['theme_id']);
        });
        Schema::dropIfExists('question_theme');
    }
}
