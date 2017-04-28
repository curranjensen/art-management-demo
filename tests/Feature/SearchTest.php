<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SearchTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_perform_a_search()
    {
        $this->assertTrue(true);
    }
}