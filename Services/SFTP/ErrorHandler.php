<?php

namespace App\Services\SFTP;

use App\Services\SFTP\Contracts\ErrorHandlerInterface;

class ErrorHandler implements ErrorHandlerInterface
{

    public function handleException(\Exception $e): void
    {
        if( ENV('APP_ENV') == 'production' ) {
            \Sentry\captureException($e);
        }
        else {
            dd($e);
        }
    }

}
