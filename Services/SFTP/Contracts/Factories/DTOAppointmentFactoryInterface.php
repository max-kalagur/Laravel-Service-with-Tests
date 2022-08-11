<?php

namespace App\Services\SFTP\Contracts\Factories;

use App\Services\SFTP\Factories\DTOAppointment;

interface DTOAppointmentFactoryInterface
{
    public function make(array $data): DTOAppointmentInterface;

}

