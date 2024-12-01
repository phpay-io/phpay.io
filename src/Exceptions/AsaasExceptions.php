<?php

namespace Payhub\Exceptions;

use Exception;

final class AsaasExceptions
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
