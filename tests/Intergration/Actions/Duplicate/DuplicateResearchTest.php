<?php

namespace Tests\Intergration\Actions\Duplicate;

use App\Http\Actions\Duplicate\DuplicateResearch;
use App\Models\Research;
use Tests\TestCase;

class DuplicateResearchTest extends TestCase
{
    /** @test */
    public function it_duplicates_the_research()
    {
        $templateResearch = Research::factory()->create();

        DuplicateResearch::duplicate($templateResearch);

//        $this->
    }
}
