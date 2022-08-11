<?php

namespace App\Services\SFTP;


class SFTPHelper
{
    const PROVIDER_REVIVAL_HEALTH = 'revival_health';
    const PROVIDER_ELNFORMATICS = 'elnformatics';

    public static function getProviders() {

        return [
            [
                'key' => self::PROVIDER_REVIVAL_HEALTH,
                'nice_name' => 'Revival Health'
            ],
            [
                'key' => self::PROVIDER_ELNFORMATICS,
                'nice_name' => 'Elnformatics'
            ],
        ];
    }
}
