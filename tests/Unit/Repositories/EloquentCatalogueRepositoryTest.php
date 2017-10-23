<?php namespace Unit\Repositories;

use App\Detail;
use App\Piece;
use Tests\TestCase;
use App\Repositories\EloquentCatalogueRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EloquentCatalogueRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var EloquentCatalogueRepository
     */
    private $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = new EloquentCatalogueRepository();
    }

    /** @test */
    public function selectForIndex()
    {
        $piece = factory(Piece::class)->create();

        factory(Detail::class)->create([
            'piece_id' => $piece->id,
            'in_catalogue' => true
        ]);

        factory(Detail::class)->create([
            'piece_id' => $piece->id,
            'in_catalogue' => false
        ]);

        $result = $this->repo->selectForIndex();

        $this->assertCount(1, $result);
    }
}