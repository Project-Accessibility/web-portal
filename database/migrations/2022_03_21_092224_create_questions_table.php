<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->uuid('question_id')->default(DB::raw('(UUID())'));;
            $table->bigInteger('version')->default(1);
            $table->foreignId('section_id');
            $table->string("title");
            $table->text("question");

            $table->foreign('section_id')->references('id')->on('sections')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();

            $table->unique(['question_id', 'version']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
