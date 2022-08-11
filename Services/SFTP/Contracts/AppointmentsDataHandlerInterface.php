<?php

namespace App\Services\SFTP\Contracts;

use App\Organization;
use App\Repositories\Contracts\AppointmentRepositoryInterface;
use App\Repositories\Contracts\ContactRepositoryInterface;
use Illuminate\Support\Collection;

interface AppointmentsDataHandlerInterface
{
    public function __construct(Organization $org,
        Collection $appointments,
        AppointmentRepositoryInterface $appointmentRepository,
        ContactRepositoryInterface $contactRepository);

    public function saveAppointments(): array;

}

