<?php

namespace Tests\Unit\Services\FileUploader;

use App\Piece;
use Mockery as m;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Services\FileUploader\Thumbnail;
use App\Services\FileUploader\FileObject;
use App\Services\FileUploader\PhotoUploader;
use App\Services\FileUploader\RandomFileName;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PhotoUploaderTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_uploads_a_file()
    {

        $piece = factory(Piece::class)->create([
            'number' => 3000
        ]);

        Storage::fake("public/details/{$piece->number}");

        $file = m::mock(UploadedFile::class, [
            'getClientOriginalName' => 'foo.jpg',
            'getClientOriginalExtension' => 'jpg',
            'getMimeType' => 'image/jpeg'
        ]);

        $file->shouldReceive('move')
            ->once()
            ->with(storage_path("app/public/details/{$piece->number}"), 'test.jpg');

        $namer = m::mock(RandomFileName::class);

        $namer->shouldReceive('makeFileName')
            ->once()->with('jpg')->andReturn('test.jpg');

        $thumbnail = m::mock(Thumbnail::class);

        $thumbnail->shouldReceive('make')
        ->once()
        ->with(storage_path("app/public/details/{$piece->number}/test.jpg"),
            storage_path("app/public/details/{$piece->number}/lg_test.jpg"),
            storage_path("app/public/details/{$piece->number}/th_test.jpg"))
            ->andReturn(new FileObject(800, 600, 1024));

        (new PhotoUploader($piece, $file, $namer, $thumbnail))->save();

        $this->assertCount(1, $piece->details);
    }
}