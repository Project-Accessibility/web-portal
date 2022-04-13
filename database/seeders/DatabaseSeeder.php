<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Geofence;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Models\Research;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'info@accessibility.nl',
            'password' => Hash::make('admin'),
        ]);

        $this->createDemoData();
    }

    private function createDemoData()
    {
        $this->createNemoResearch();

        // More demo data can be added here.
    }

    private function createNemoResearch()
    {
        $research = Research::factory()->create([
            'title' => 'NEMO onderzoek',
            'description' =>
                'Dit is onderzoek is in samenwerking met NEMO om te kijken naar de toegankelijkheid vanaf de website tot en met het bezoek.',
        ]);

        $this->createNemoQuestionnaire($research);
    }

    private function createNemoQuestionnaire(Research $research)
    {
        $questionnaire = Questionnaire::factory()->create([
            'research_id' => $research->id,
            'title' => 'Vragenlijst toegankelijkheid',
            'description' => 'De algemene vragenlijst.',
        ]);

        $this->createNemoSections($questionnaire);
    }

    private function createNemoSections(Questionnaire $questionnaire)
    {
        $entrance_section = Section::factory()->create([
            'questionnaire_id' => $questionnaire->id,
            'title' => 'Entree',
            'description' =>
                'Benoem zowel je positieve als negatieve ervaringen.',
            'location_description' =>
                'Dit is het gedeelte waar je NEMO binnen komt.',
        ]);

        $information_section = Section::factory()->create([
            'questionnaire_id' => $questionnaire->id,
            'title' => 'Kassa/infobalie',
            'description' =>
                'Benoem zowel je positieve als negatieve ervaringen.',
            'location_description' =>
                'Hier kan je meer informatie vragen en kaartjes kopen.',
        ]);
    }
}
