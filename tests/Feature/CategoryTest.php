<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function media_table_can_be_populated()
    {
        Category::populate();

        $this->assertArraySubset([
            'earth',
            'angels',
            'celebration',
            'abstract',
        ], Category::all()->pluck('type'));
    }
}