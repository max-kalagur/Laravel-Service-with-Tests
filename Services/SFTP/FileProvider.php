<?php

namespace App\Services\SFTP;

use App\Organization;
use App\Services\SFTP\Contracts\FileProviderInterface;
use Illuminate\Support\Facades\Storage;

class FileProvider implements FileProviderInterface
{
    protected $org;

    public function setOrg(Organization $org): void
    {
        $this->org = $org;
    }

    /**
     * Get files from Organization directory.
     *
     * @return SplFileInfo[]|array
     */
    public function getFiles(): array
    {

        $files = Storage::disk('appointments')
                        ->files($this->org->getSetting('SFTP_FOLDER'));

        return $files;
    }

}
