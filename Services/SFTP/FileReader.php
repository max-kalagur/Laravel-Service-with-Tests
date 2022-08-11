<?php

namespace App\Services\SFTP;

use Maatwebsite\Excel\Concerns\ToCollection;
use App\Organization;
use App\Services\SFTP\Contracts\Factories\DTOAppointmentFactoryInterface;
use App\Services\SFTP\Contracts\FileProviderInterface;
use App\Services\SFTP\Contracts\FileReaderInterface;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class FileReader implements FileReaderInterface
{
    protected $fileProvider;
    protected $importer;
    protected $DTOFactory;

    public function __construct(FileProviderInterface $fileProvider, ToCollection $importer, DTOAppointmentFactoryInterface $DTOFactory)
    {
        $this->fileProvider = $fileProvider;
        $this->importer = $importer;
        $this->DTOFactory = $DTOFactory;
    }

    public function getAppointmentsData(Organization $org): Collection
    {
        $this->fileProvider->setOrg($org);

        $files = $this->fileProvider->getFiles();

        $appointmentsData = new Collection();

        foreach($files as $file)
        {
            $appointmentsData = $appointmentsData->merge(
                Excel::toCollection($this->importer, $file->getPathname())
            );
        }

        $appointmentsWithContacts = $appointmentsData->map(function($appt) {
            $this->DTOFactory->make($appt);
        });

        return $appointmentsWithContacts;
    }
}
