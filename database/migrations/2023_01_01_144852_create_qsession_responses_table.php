<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQsessionResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsession_responses', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('score');
            $table->unsignedInteger('state');

            $table->unsignedBigInteger('qsession_id');
            $table->foreign('qsession_id')->references('id')->on('qsessions')->onDelete('cascade');

            $table->unsignedBigInteger('response_id');
            $table->foreign('response_id')->references('id')->on('responses')->onDelete('cascade');

            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

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
        Schema::dropIfExists('qsession_responses');
    }
}
