<?php

namespace App\Services\SFTP\Contracts;

use Maatwebsite\Excel\Concerns\ToCollection;
use App\Organization;
use App\Services\SFTP\Contracts\Factories\DTOAppointmentFactoryInterface;
use Illuminate\Support\Collection;

interface FileReaderInterface
{
    public function __construct(FileProviderInterface $fileProvider, ToCollection $importer, DTOAppointmentFactoryInterface $DTOFactory);

    public function getAppointmentsData(Organization $org): Collection;

}

