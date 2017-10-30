<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraintToAnswersAndChoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('choices', function(Blueprint $table) {
            $table->integer('question_id')->unsigned()->after('id');
            $table->foreign('question_id')->references('id')->on('questions');
        });

        Schema::table('answers', function(Blueprint $table) {
            $table->integer('user_id')->unsigned()->after('id');
            $table->integer('choice_id')->unsigned()->after('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('choice_id')->references('id')->on('choices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('choices', function(Blueprint $table) {
            $table->dropForeign('choices_question_id_foreign');
            $table->dropColumn('question_id');
        });

        Schema::table('answers', function(Blueprint $table) {
            $table->dropForeign('answers_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
