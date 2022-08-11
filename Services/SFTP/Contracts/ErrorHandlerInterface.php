<?php

namespace App\Services\SFTP\Contracts;

use App\Organization;

interface ErrorHandlerInterface
{

    public function handleException(\Exception $e): void;

}

