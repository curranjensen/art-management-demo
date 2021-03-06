<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewCatalogueTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_shows_a_list_of_catalogue_entries()
    {
        $response = $this->get('/catalogue');

        $response->assertStatus(200);
    }
}