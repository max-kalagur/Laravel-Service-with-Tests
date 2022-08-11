<?php

namespace App\Services\SFTP;

use App\Organization;
use App\Repositories\Contracts\OrganizationRepositoryInterface;
use App\Services\SFTP\Contracts\AppointmentsDataHandlerInterface;
use App\Services\SFTP\Contracts\FileReaderInterface;
use App\Services\SFTP\Contracts\ImportAppointmentsHandlerInterface;

class ImportAppointmentsHandler implements ImportAppointmentsHandlerInterface
{
    protected $fileReader;
    protected $appointmentsDataHandler;
    protected $organizationRepository;

    public function __construct(FileReaderInterface $fileReader,
        AppointmentsDataHandlerInterface $appointmentsDataHandler,
        OrganizationRepositoryInterface $organizationRepository)
    {
        $this->fileReader = $fileReader;
        $this->appointmentsDataHandler = $appointmentsDataHandler;
        $this->organizationRepository = $organizationRepository;
    }

    public function importAppointments(): void
    {
        $orgs = $this->organizationRepository->getWithSFTPPlatforms();

        $orgs->each(function($org) {
            $appointments = $this->fileReader->getAppointmentsData($org);
            $this->appointmentsDataHandler->saveAppointments($org, $appointments);
        });
    }
}
