<?php

namespace App\Services\SFTP\Contracts;

use App\Organization;

interface ImportAppointmentsHandlerInterface
{

    public function importAppointments(): void;

}

