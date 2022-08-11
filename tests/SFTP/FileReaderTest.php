<?php

namespace Tests\Unit\SFTP;

use App\Services\SFTP\FileReader;
use Illuminate\Support\Collection;
use Mockery\MockInterface;
use SplFileInfo;
use Tests\TestCase;

class FileReaderTest extends TestCase
{
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_file_reads()
    {
        $org = $this->mock('\App\Organization');
        $testAppointment = ['appointment' => 'test'];
        $fileObject = new SplFileInfo('some-path');

        $fileProvider = $this->mock('\App\Services\SFTP\Contracts\FileProviderInterface',
            function (MockInterface $mock) use($org, $fileObject) {
                $mock->shouldReceive('setOrg')
                    ->with($org)
                    ->once()
                    ->andReturn(null)
                    ->shouldReceive('getFiles')
                    ->once()
                    ->andReturn([$fileObject]);
        });

        $importer = $this->mock('Maatwebsite\Excel\Concerns\ToCollection');
        $DTOAppointment = $this->mock('\App\Services\SFTP\Contracts\Factories\DTOAppointmentInterface');

        $DTOFactory = $this->mock('\App\Services\SFTP\Contracts\Factories\DTOAppointmentFactoryInterface',
            function (MockInterface $mock) use($testAppointment, $DTOAppointment) {
                $mock->shouldReceive('make')
                    ->with($testAppointment)
                    ->once()
                    ->andReturn($DTOAppointment);
        });

        $this->mock('alias:\Maatwebsite\Excel\Facades\Excel',
            function (MockInterface $mock) use($testAppointment) {
                $mock->shouldReceive('toCollection')
                    ->once()
                    ->andReturn(new Collection([$testAppointment]));
        });

        $fileReader = new FileReader($fileProvider, $importer, $DTOFactory);

        $this->assertIsIterable($fileReader->getAppointmentsData($org));
    }
}
