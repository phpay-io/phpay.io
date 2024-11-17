<?php

namespace Payhub\Exceptions;

use Exception;

class AsaasExceptions
{
    /**
     * AsaasExceptions invokable.
     *
     * @param string $message
     */
    public function __invoke(string $message): Exception
    {
        return throw new Exception('Gateway Asaas: ' . $message);
    }
}
