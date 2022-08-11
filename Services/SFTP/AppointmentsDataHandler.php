<?php

namespace App\Services\SFTP;

use App\Appointment;
use App\Contact;
use App\Organization;
use App\Repositories\Contracts\AppointmentRepositoryInterface;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Services\SFTP\Contracts\AppointmentsDataHandlerInterface;
use Illuminate\Support\Collection;

class AppointmentsDataHandler implements AppointmentsDataHandlerInterface
{
    protected $org;
    protected $appointments;
    protected $appointmentRepository;
    protected $contactRepository;

    public function __construct(Organization $org,
        Collection $appointments,
        AppointmentRepositoryInterface $appointmentRepository,
        ContactRepositoryInterface $contactRepository)
    {
        $this->org = $org;
        $this->appointments = $appointments;
        $this->appointmentRepository = $appointmentRepository;
        $this->contactRepository = $contactRepository;
    }

    public function saveAppointments(): array
    {
        $res = [];

        $appointments = $this->appointments->map(fn($item) => $item->appointment );
        $contacts = $this->appointments->map(fn($item) => $item->contact );

        $res['appointments'][] = $this->appointmentRepository->createManyFromSFTP($appointments);
        $res['contacts'][] = $this->contactRepository->createManyFromSFTP($contacts);

        return $res;
    }

}
