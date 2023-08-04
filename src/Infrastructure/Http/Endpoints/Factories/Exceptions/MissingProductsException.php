<?php

namespace App\Infrastructure\Http\Endpoints\Factories\Exceptions;

final class MissingProductsException extends InvalidRequestException
{
    public function __construct()
    {
        parent::__construct('Missing "products" property.');
    }
}
