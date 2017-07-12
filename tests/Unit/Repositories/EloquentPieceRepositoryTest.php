<?php namespace Unit\Repositories;

use App\Piece;
use Tests\TestCase;
use App\Repositories\EloquentPieceRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EloquentPieceRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var EloquentPieceRepository
     */
    private $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = new EloquentPieceRepository();
    }

    /** @test */
    public function selectForIndex()
    {
        $sort = ['name', 'asc'];

        factory(Piece::class)->create([
            'name' => 'First Piece'
        ]);

        factory(Piece::class)->create([
            'name' => 'Second Piece'
        ]);

        $result = $this->repo->selectForIndex($sort, $medium = false);

        $this->assertEquals('First Piece', $result->first()->name);
    }

    /** @test */
    public function getNextPieceNumber()
    {
        factory(Piece::class)->create([
            'number' => 1
        ]);

        $result = $this->repo->getNextPieceNumber();

        $this->assertEquals(2, $result);
    }

    /** @test */
    public function create()
    {
        $attributes = [
            'name' => 'First Piece',
            'size' => '30 x 30',
            'month' => 1,
            'year' => 2004,
            'number' => 1,
            'notes' => 'A note',
            'status' => 'A status',
            'licences' => 'A licence',
            'media_id' => 1
        ];

        $this->repo->create($attributes);

        $piece = Piece::where([
            'name' => 'First Piece',
            'size' => '30 x 30',
            'month' => 1,
            'year' => 2004,
            'number' => 1,
            'notes' => 'A note',
            'status' => 'A status',
            'licences' => 'A licence',
            'media_id' => 1
        ])->first();

        $this->assertNotNull($piece);

    }

    /** @test */
    public function getPrevious()
    {
        factory(Piece::class)->create([
            'name' => 'First Piece',
            'number' => 1
        ]);

        $piece2 = factory(Piece::class)->create([
            'name' => 'Second Piece',
            'number' => 2
        ]);

        $result = $this->repo->getPrevious($piece2);

        $this->assertEquals('First Piece', $result->name);
    }

    /** @test */
    public function getNext()
    {
        $piece1 = factory(Piece::class)->create([
            'name' => 'First Piece',
            'number' => 1
        ]);

        factory(Piece::class)->create([
            'name' => 'Second Piece',
            'number' => 2
        ]);

        $result = $this->repo->getNext($piece1);

        $this->assertEquals('Second Piece', $result->name);
    }

    /** @test */
    public function kill()
    {
        $piece = factory(Piece::class)->create();

        $this->repo->kill($piece);

        $piece = Piece::find($piece->id);

        $this->assertNull($piece);
    }

    /** @test */
    public function update()
    {
        $piece = factory(Piece::class)->create();

        $attributes = [
            'name' => 'First Piece',
            'size' => '30 x 30',
            'month' => 1,
            'year' => 2004,
            'notes' => 'A note',
            'status' => 'A status',
            'licences' => 'A licence',
            'media_id' => 1
        ];

        $this->repo->update($piece, $attributes);

        $piece = Piece::where([
            'name' => 'First Piece',
            'size' => '30 x 30',
            'month' => 1,
            'year' => 2004,
            'notes' => 'A note',
            'status' => 'A status',
            'licences' => 'A licence',
            'media_id' => 1
        ])->first();

        $this->assertNotNull($piece);
    }

    /** @test */
    public function getAllForExport()
    {
        factory(Piece::class, 3)->create();

        $result = $this->repo->getAllForExport();

        $this->assertCount(3, $result);
    }

    /** @test */
    public function search()
    {
        factory(Piece::class)->create([
            'name' => 'First Piece'
        ]);

        $query = 'First Piece';

        $result = $this->repo->search($query);

        $this->assertEquals('First Piece', $result->first()->name);
    }
}