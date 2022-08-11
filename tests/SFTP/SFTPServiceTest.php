<?php

namespace Tests\Unit\SFTPService;

use App\Services\SFTP\SFTPService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;
use Tests\TestCase;

class SFTPServiceTest extends TestCase
{

    public function test_appts_import_runs()
    {
        $importHandler = $this->mock('\App\Services\SFTP\Contracts\ImportAppointmentsHandlerInterface', function (MockInterface $mock) {
            $mock->shouldReceive('importAppointments')
                ->once()
                ->andReturn(null);
        });
        
        $errorHandler = $this->mock('\App\Services\SFTP\Contracts\ErrorHandlerInterface', function (MockInterface $mock) {
            $mock->shouldNotHaveBeenCalled();
        });

        $this->assertNull( SFTPService::importAppointments($importHandler, $errorHandler) );
    }
}
