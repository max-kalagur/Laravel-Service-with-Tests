<?php

namespace App\Services\SFTP\Factories;

use App\Services\SFTP\Contracts\Factories\DTOAppointmentInterface;

class DTOAppointment implements DTOAppointmentInterface
{
    public $appointment;
    public $contact;

    public function __construct(array $data)
    {
        $this->appointment = [
            'platform_item_id' => $data["appointment_id"],
            'end_time' => $data["appointment_date"] .' '. $data["appointment_end_time"],
            'external_provider_id' => $data["provider_id"],
            'external_location_id' => $data["location_id"],
            'future_appointment_date' => $data["future_appointment_date"],
        ];

        $this->contact = [
            'uuid' => $data["patient_id"],
            'first_name' => $data["patient_first_name"],
            'last_name' => $data["patient_last_name"],
            'phone' => $data["patient_cell_phone"],
            'email' => $data["patient_email"],
            'extra_data' => json_encode(['notification_preference' => $data["patient_notification_preference"]]),
        ];
    }

}
