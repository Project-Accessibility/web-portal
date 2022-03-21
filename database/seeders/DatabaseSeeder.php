<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Geofence;
use App\Models\QuestionOption;
use App\Models\Research;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
     User::factory(3)->create();
     Answer::factory(3)->create();
  }
}
