<?php namespace Unit\Repositories;

use App\Piece;
use App\Detail;
use Tests\TestCase;
use App\Repositories\EloquentDetailRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EloquentDetailRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var EloquentDetailRepository
     */
    private $repo;

    public function setUp()
    {
        parent::setUp();
        $this->repo = new EloquentDetailRepository();
    }

    /** @test */
    public function selectForIndex()
    {
        $sort = ['number', 'asc'];

        $piece1 = factory(Piece::class)->create([
            'number' => 1
        ]);

        factory(Detail::class)->create([
            'piece_id' => $piece1->id
        ]);

        $piece2 = factory(Piece::class)->create([
            'number' => 2
        ]);

        factory(Detail::class)->create([
            'piece_id' => $piece2->id
        ]);

        $result = $this->repo->selectForIndex($sort);

        $this->assertEquals(1, $result->first()->piece->number);
    }

    /** @test */
    public function getPrevious()
    {
        $piece = factory(Piece::class)->create();

        factory(Detail::class)->create([
            'piece_id' => $piece->id,
            'width' => 500
        ]);

        $detail2 = factory(Detail::class)->create([
            'piece_id' => $piece->id,
            'width' => 400
        ]);

        $result = $this->repo->getPrevious($piece, $detail2);

        $this->assertEquals(500, $result->width);
    }

    /** @test */
    public function getNext()
    {
        $piece = factory(Piece::class)->create();

        $detail1 = factory(Detail::class)->create([
            'piece_id' => $piece->id,
            'width' => 500
        ]);

        factory(Detail::class)->create([
            'piece_id' => $piece->id,
            'width' => 400
        ]);

        $result = $this->repo->getNext($piece, $detail1);

        $this->assertEquals(400, $result->width);
    }

    /** @test */
    public function kill()
    {
        $detail = factory(Detail::class)->create([
            'width' => 500
        ]);

        $this->repo->kill($detail);

        $detail = Detail::where('width', 500)->first();

        $this->assertNull($detail);
    }

    /** @test */
    public function makeDefault()
    {
        $detail = factory(Detail::class)->create([
            'is_default' => false
        ]);

        $this->repo->makeDefault($detail);

        $this->assertTrue($detail->fresh()->is_default);
    }

    /** @test */
    public function removeDefault()
    {
        $detail = factory(Detail::class)->create([
            'is_default' => true
        ]);

        $this->repo->removeDefault($detail);

        $this->assertFalse($detail->fresh()->is_default);
    }

    /** @test */
    public function getAllForExport()
    {
        factory(Detail::class, 3)->create();

        $result = $this->repo->getAllForExport();

        $this->assertCount(3, $result);
    }

    /** @test */
    public function getRandomDetail()
    {
        factory(Detail::class, 3)->create();

        $result = $this->repo->getRandomDetail();

        $this->assertInstanceOf(Detail::class, $result);
    }

    /** @test */
    public function search()
    {
        $query = 500;

        factory(Detail::class)->create([
            'width' => '500'
        ]);

        $result = $this->repo->search($query);

        $this->assertEquals(500, $result->first()->width);
    }

    /** @test */
    public function all()
    {
        factory(Detail::class, 3)->create();

        $result = $this->repo->all();

        $this->assertCount(3, $result);
    }
}