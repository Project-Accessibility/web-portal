<?php

namespace Tests\Feature\Questionnaire;

use App\Models\Questionnaire;
use App\Models\Research;
use App\Models\User;
use Tests\TestCase;

class QuestionnaireTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function the_questionnaire_overview_page_gives_a_200_status()
    {
        $questionnaire = Questionnaire::factory()->create();

        $response = $this->followingRedirects()->get(
            '/researches/' . $questionnaire->research->id . '/questionnaires',
        );

        $response->assertStatus(200);
    }

    /** @test */
    public function the_questionnaire_overview_page_has_the_correct_data()
    {
        $questionnaire = Questionnaire::factory()->create();

        $response = $this->followingRedirects()->get(
            '/researches/' . $questionnaire->research->id . '/questionnaires',
        );

        $response->assertSee($questionnaire->title);
    }

    /** @test */
    public function the_questionnaire_create_page_gives_a_200_status()
    {
        $research = Research::factory()->create();

        $response = $this->get(
            '/researches/' . $research->id . '/questionnaires/create',
        );

        $response->assertStatus(200);
    }

    /** @test */
    public function the_questionnaire_store_route_creates_a_questionnaire()
    {
        $research = Research::factory()->create();

        $this->post('/researches/' . $research->id . '/questionnaires', [
            'title' => 'THIS_IS_A_TEST_TITLE',
        ]);

        $this->assertDatabaseHas('questionnaires', [
            'title' => 'THIS_IS_A_TEST_TITLE',
        ]);
    }

    /** @test */
    public function the_questionnaire_store_route_redirects_to_the_questionnaire_overview_page()
    {
        $research = Research::factory()->create();

        $response = $this->post(
            '/researches/' . $research->id . '/questionnaires',
            [
                'title' => 'THIS_IS_A_TEST_TITLE',
            ],
        );

        $response->assertRedirect(
            '/researches/' . $research->id . '?tab=Vragenlijsten',
        );
    }

    /** @test */
    public function the_questionnaire_details_pages_gives_a_200_status()
    {
        $questionnaire = Questionnaire::factory()->create();

        $response = $this->followingRedirects()->get(
            '/researches/' .
                $questionnaire->research->id .
                '/questionnaires/' .
                $questionnaire->id,
        );

        $response->assertStatus(200);
    }

    /** @test */
    public function the_questionnaire_details_page_has_the_correct_data()
    {
        $questionnaire = Questionnaire::factory()->create();

        $response = $this->followingRedirects()->get(
            '/researches/' .
                $questionnaire->research->id .
                '/questionnaires/' .
                $questionnaire->id,
        );

        $response->assertSee($questionnaire->title);
    }

    /** @test */
    public function the_questionnaire_edit_page_gives_a_200_status()
    {
        $questionnaire = Questionnaire::factory()->create();

        $response = $this->followingRedirects()->get(
            '/researches/' .
                $questionnaire->research->id .
                '/questionnaires/' .
                $questionnaire->id .
                '/edit',
        );

        $response->assertStatus(200);
    }

    /** @test */
    public function the_questionnaire_edit_page_has_the_correct_data()
    {
        $questionnaire = Questionnaire::factory()->create();

        $response = $this->followingRedirects()->get(
            '/researches/' .
                $questionnaire->research->id .
                '/questionnaires/' .
                $questionnaire->id .
                '/edit',
        );

        $response->assertSee($questionnaire->title);
    }

    /** @test */
    public function the_questionnaire_update_route_edits_the_questionnaire()
    {
        $questionnaire = Questionnaire::factory()->create([
            'title' => 'THIS_IS_THE_BEFORE_TITLE',
        ]);

        $this->put(
            '/researches/' .
                $questionnaire->research->id .
                '/questionnaires/' .
                $questionnaire->id,
            [
                'title' => 'THIS_IS_THE_AFTER_TITLE',
            ],
        );

        $this->assertDatabaseHas('questionnaires', [
            'title' => 'THIS_IS_THE_AFTER_TITLE',
        ]);
        $this->assertDatabaseMissing('questionnaires', [
            'title' => 'THIS_IS_THE_BEFORE_TITLE',
        ]);
    }

    /** @test */
    public function the_questionnaire_update_route_redirects_to_the_questionnaire_details_page()
    {
        $questionnaire = Questionnaire::factory()->create([
            'title' => 'THIS_IS_THE_BEFORE_TITLE',
        ]);

        $response = $this->put(
            '/researches/' .
                $questionnaire->research->id .
                '/questionnaires/' .
                $questionnaire->id,
            [
                'title' => 'THIS_IS_THE_AFTER_TITLE',
            ],
        );

        $response->assertRedirect(
            '/researches/' .
                $questionnaire->research->id .
                '/questionnaires/' .
                $questionnaire->id .
                '?tab=Details',
        );
    }

    /** @test */
    public function the_questionnaire_delete_route_deletes_the_questionnaire()
    {
        $questionnaire = Questionnaire::factory()->create([
            'title' => 'THIS_IS_A_TEST_TITLE',
        ]);

        $this->delete(
            '/researches/' .
                $questionnaire->research->id .
                '/questionnaires/' .
                $questionnaire->id,
        );

        $this->assertDatabaseMissing('questionnaires', [
            'title' => 'THIS_IS_A_TEST_TITLE',
        ]);
    }

    /** @test */
    public function the_questionnaire_delete_route_redirects_to_the_questionnaire_overview_page()
    {
        $questionnaire = Questionnaire::factory()->create();

        $response = $this->delete(
            '/researches/' .
                $questionnaire->research->id .
                '/questionnaires/' .
                $questionnaire->id,
        );

        $response->assertRedirect(
            '/researches/' .
                $questionnaire->research->id .
                '?tab=Vragenlijsten',
        );
    }
}
