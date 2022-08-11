<?php

namespace Tests\Unit\SFTPService;

use App\Services\SFTP\Factories\DTOAppointment;
use Tests\TestCase;

class DTOAppointmentTest extends TestCase
{

    public function test_dto_is_fillable_and_transforms_data()
    {
        $excelData = [
            "location_id" => "loc123",
            "appointment_status" => "fulfilled",
            "appointment_id" => "apt123",
            "appointment_end_time" => "10:20:00",
            "appointment_date" => "2022-10-10",
            "future_appointment_date" => "2022-10-10",
            "provider_id" => "prov123",
            "provider_name" => "Jon",
            "patient_id" => "pat123",
            "patient_first_name" => "Mary",
            "patient_last_name" => "Garcia",
            "patient_email" => "test@test.com",
            "patient_cell_phone" => "+123456789",
            "patient_notification_preference" => "cell",
        ];

        $expectedAppointment = [
            'platform_item_id' => $excelData["appointment_id"],
            'end_time' => $excelData["appointment_date"] .' '. $excelData["appointment_end_time"],
            'external_provider_id' => $excelData["provider_id"],
            'external_location_id' => $excelData["location_id"],
            'future_appointment_date' => $excelData["future_appointment_date"],
        ];
        $expectedContact = [
            'uuid' => $excelData["patient_id"],
            'first_name' => $excelData["patient_first_name"],
            'last_name' => $excelData["patient_last_name"],
            'phone' => $excelData["patient_cell_phone"],
            'email' => $excelData["patient_email"],
            'extra_data' => json_encode(['notification_preference' => $excelData["patient_notification_preference"]]),
        ];

        $dto = new DTOAppointment($excelData);

        $this->assertSame($expectedAppointment, $dto->appointment);
        $this->assertSame($expectedContact, $dto->contact);
    }
}
