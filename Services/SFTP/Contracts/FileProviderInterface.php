<?php

namespace App\Services\SFTP\Contracts;

use App\Organization;

interface FileProviderInterface
{

    public function setOrg(Organization $org): void;

    public function getFiles(): array;

}

