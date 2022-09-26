<?php

namespace App\Traits;

use App\Exceptions\VeridcaException;

trait ApiException
{
    /**
     * Returna a bad request exception.
     *
     * @param array|string $exception
     * @return void
     */
    public function badRequestException(array|string $exception): void
    {
        throw new VeridcaException($exception, 400);
    }

    /**
     * Returna a pre condition failed exception.
     *
     * @param array|string $exception
     * @return void
     */
    public function preConditionFailedException(array|string $exception): void
    {
        throw new VeridcaException($exception, 412);
    }
}
