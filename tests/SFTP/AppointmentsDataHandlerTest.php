<?php

namespace Tests\Unit\SFTP;

use App\Services\SFTP\AppointmentsDataHandler;
use Illuminate\Support\Collection;
use Mockery\MockInterface;
use Tests\TestCase;

class AppointmentsDataHandlerTest extends TestCase
{

    public function test_appointments_are_saved()
    {
        $org = $this->mock('\App\Organization');
        $appointments = new Collection([(object)['appointment'=>[],'contact'=>[]]]);

        $appointmentRepository = $this->mock('\App\Repositories\Contracts\AppointmentRepositoryInterface',
            function (MockInterface $mock) use($org) {
                $mock->shouldReceive('createManyFromSFTP')
                    ->once()
                    ->andReturn([1,2,3]);
        });
        $contactRepository = $this->mock('\App\Repositories\Contracts\ContactRepositoryInterface',
            function (MockInterface $mock) use($org) {
                $mock->shouldReceive('createManyFromSFTP')
                    ->once()
                    ->andReturn([1,2,3]);
        });

        $dataHandler = new AppointmentsDataHandler(
            $org,
            $appointments,
            $appointmentRepository,
            $contactRepository
        );

        $this->assertIsIterable($dataHandler->saveAppointments());
    }
}
