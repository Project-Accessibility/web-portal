<?php

namespace Tests\Feature\Research;

use App\Models\Research;
use App\Models\User;
use Tests\TestCase;

class ResearchTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function the_research_overview_page_gives_a_200_status()
    {
        $response = $this->get('/researches');

        $response->assertStatus(200);
    }

    /** @test */
    public function the_research_overview_page_has_the_correct_data()
    {
        $research = Research::factory()->create();

        $response = $this->get('/researches');

        $response->assertSee($research->title);
    }

    /** @test */
    public function the_research_create_page_gives_a_200_status()
    {
        $response = $this->get('/researches/create');

        $response->assertStatus(200);
    }

    /** @test */
    public function the_research_store_route_creates_a_research()
    {
        $this->post('/researches', [
            'title' => 'THIS_IS_A_TEST_TITLE',
        ]);

        $this->assertDatabaseHas('researches', [
            'title' => 'THIS_IS_A_TEST_TITLE',
        ]);
    }

    /** @test */
    public function the_research_store_route_redirects_to_the_research_overview_page()
    {
        $response = $this->post('/researches', [
            'title' => 'THIS_IS_A_TEST_TITLE',
        ]);

        $response->assertRedirect('/researches');
    }

    /** @test */
    public function the_research_details_pages_gives_a_200_status()
    {
        $research = Research::factory()->create();

        $response = $this->get('/researches/' . $research->id);

        $response->assertStatus(200);
    }

    /** @test */
    public function the_research_details_page_has_the_correct_data()
    {
        $research = Research::factory()->create();

        $response = $this->get('/researches/' . $research->id);

        $response->assertSee($research->title);
    }

    /** @test */
    public function the_research_edit_page_gives_a_200_status()
    {
        $research = Research::factory()->create();

        $response = $this->get('/researches/' . $research->id . '/edit');

        $response->assertStatus(200);
    }

    /** @test */
    public function the_research_edit_page_has_the_correct_data()
    {
        $research = Research::factory()->create();

        $response = $this->get('/researches/' . $research->id . '/edit');

        $response->assertSee($research->title);
    }

    /** @test */
    public function the_research_update_route_edits_the_research()
    {
        $research = Research::factory()->create([
            'title' => 'THIS_IS_THE_BEFORE_TITLE',
        ]);

        $this->put('/researches/' . $research->id, [
            'title' => 'THIS_IS_THE_AFTER_TITLE',
        ]);

        $this->assertDatabaseHas('researches', [
            'title' => 'THIS_IS_THE_AFTER_TITLE',
        ]);
        $this->assertDatabaseMissing('researches', [
            'title' => 'THIS_IS_THE_BEFORE_TITLE',
        ]);
    }

    /** @test */
    public function the_research_update_route_redirects_to_the_research_details_page()
    {
        $research = Research::factory()->create([
            'title' => 'THIS_IS_THE_BEFORE_TITLE',
        ]);

        $response = $this->put('/researches/' . $research->id, [
            'title' => 'THIS_IS_THE_AFTER_TITLE',
        ]);

        $response->assertRedirect(
            'researches/' . $research->id . '?tab=Details',
        );
    }

    /** @test */
    public function the_research_delete_route_deletes_the_research()
    {
        $research = Research::factory()->create([
            'title' => 'THIS_IS_A_TEST_TITLE',
        ]);

        $this->delete('/researches/' . $research->id);

        $this->assertDatabaseMissing('researches', [
            'title' => 'THIS_IS_A_TEST_TITLE',
        ]);
    }

    /** @test */
    public function the_research_delete_route_redirects_to_the_research_overview_page()
    {
        $research = Research::factory()->create();

        $response = $this->delete('/researches/' . $research->id);

        $response->assertRedirect('/researches');
    }
}
