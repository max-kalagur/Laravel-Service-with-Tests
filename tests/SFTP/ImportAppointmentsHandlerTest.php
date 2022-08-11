<?php

namespace Tests\Unit\SFTP;

use App\Organization;
use App\Services\SFTP\ImportAppointmentsHandler;
use Illuminate\Database\Eloquent\Collection;
use Mockery\MockInterface;
use Tests\TestCase;

class ImportAppointmentsHandlerTest extends TestCase
{

    public function test_import_appointments()
    {
        $org = new Organization(['id'=>1]);
        $orgs = new Collection([$org]);

        $fileReader = $this->mock('\App\Services\SFTP\Contracts\FileReaderInterface',
        function (MockInterface $mock) use($org) {
            $mock->shouldReceive('getAppointmentsData')
                ->with($org)
                ->once()
                ->andReturn(new Collection([]));
        });

        $appointmentsDataHandler = $this->mock('\App\Services\SFTP\Contracts\AppointmentsDataHandlerInterface', function (MockInterface $mock) {
            $mock->shouldReceive('saveAppointments')
                ->once()
                ->andReturn([1,2,3]);
        });


        $organizationRepository = $this->mock('\App\Repositories\Contracts\OrganizationRepositoryInterface',
        function (MockInterface $mock) use($orgs) {
            $mock->shouldReceive('getWithSFTPPlatforms')
                ->once()
                ->andReturn($orgs);
        });

        $importHandler = new ImportAppointmentsHandler(
            $fileReader,
            $appointmentsDataHandler,
            $organizationRepository
        );

        $this->assertNull($importHandler->importAppointments());
    }
}
