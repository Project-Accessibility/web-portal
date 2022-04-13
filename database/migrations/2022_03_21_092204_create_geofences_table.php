<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('geofences', function (Blueprint $table) {
            $table->id();
            $table->float("longitude", 13,7);
            $table->float("latitude",13,7);
            $table->float("radius");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('geofences');
    }
};
