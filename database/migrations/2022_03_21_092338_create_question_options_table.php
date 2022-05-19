<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id');
            $table->enum('type', ["OPEN", "IMAGE", "VIDEO", "VOICE", "MULTIPLE_CHOICE", "RANGE", "DATE", "DATETIME"]);
            $table->text('extra_data');

            $table->foreign('question_id')->references('id')->on('questions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_options');
    }
};
