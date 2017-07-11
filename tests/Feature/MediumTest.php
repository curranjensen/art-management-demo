<?php

namespace Tests\Feature;

use App\Medium;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MediumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function media_table_can_be_populated()
    {
        Medium::populate();

        $this->assertArraySubset([
            'painting on silk',
            'pen and ink drawing',
            'studio photo',
            'exhibition photo',
        ], Medium::all()->pluck('type'));
    }
}