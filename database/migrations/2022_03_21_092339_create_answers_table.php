<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id');
            $table->foreignId('question_option_id');
            $table->json("values")->nullable();

            $table->foreign('participant_id')->references('id')->on('participants')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('question_option_id')->references('id')->on('question_options')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
};
