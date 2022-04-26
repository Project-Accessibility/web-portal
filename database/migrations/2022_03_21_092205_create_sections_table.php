<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionnaire_id');
            $table->foreignId('geofence_id')->nullable();
            $table->string("title");
            $table->text("description")->nullable();
            $table->text("location")->nullable();

            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('geofence_id')->references('id')->on('geofences')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
