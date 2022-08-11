<?php

namespace App\Services\SFTP\Factories;

use App\Services\SFTP\Contracts\Factories\DTOAppointmentFactoryInterface;

class DTOAppointmentFactory implements DTOAppointmentFactoryInterface
{

    public function make(array $data): DTOAppointment
    {
        return new DTOAppointment($data);
    }

}
