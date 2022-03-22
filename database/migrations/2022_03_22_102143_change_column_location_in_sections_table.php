<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->renameColumn('location', 'location_description');
        });
    }

    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->renameColumn('location_description', 'location');
        });
    }
};
