<?php

namespace Tests\Unit\SFTP;

use App\Services\SFTP\FileProvider;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileProviderTest extends TestCase
{

    public function test_return_file_path()
    {
        $folderPath = 'some-folder';

        $org = $this->mock('\App\Organization',
            function ( $mock ) use( $folderPath ) {
                $mock->shouldReceive('getSetting')
                    ->with("SFTP_FOLDER")
                    ->once()
                    ->andReturn($folderPath);
            });

        $storage = Storage::fake('appointments');

        Storage::shouldReceive('disk')
            ->with('appointments')
            ->andReturn($storage)
            ->shouldReceive('files')
            ->with($folderPath)
            ->andReturn([]);

        $fileProvider = new FileProvider();
        $fileProvider->setOrg($org);

        $this->assertIsArray($fileProvider->getFiles());
    }
}
