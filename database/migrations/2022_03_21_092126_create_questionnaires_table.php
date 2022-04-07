<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_id');
            $table->string("title");
            $table->text("description")->nullable();
            $table->text("instructions")->nullable();
            $table->boolean("open")->default(false);

            $table->foreign('research_id')->references('id')->on('researches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questionnaires');
    }
};
