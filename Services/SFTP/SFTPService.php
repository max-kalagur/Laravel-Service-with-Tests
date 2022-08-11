<?php

namespace App\Services\SFTP;

use App\Services\SFTP\Contracts\ErrorHandlerInterface;
use App\Services\SFTP\Contracts\ImportAppointmentsHandlerInterface;

class SFTPService
{

    public static function importAppointments(ImportAppointmentsHandlerInterface $importHandler, ErrorHandlerInterface $errorHandler): void
    {

        try {
            $importHandler->importAppointments();
        }
        catch(\Exception $e) {
            $errorHandler->handleException($e);
        }

    }

}
