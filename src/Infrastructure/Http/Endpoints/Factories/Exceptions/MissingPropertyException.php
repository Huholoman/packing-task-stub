<?php

namespace App\Infrastructure\Http\Endpoints\Factories\Exceptions;

class MissingPropertyException extends InvalidRequestException
{
    public function __construct(string $propertyName) {
        parent::__construct(sprintf('Missing product property "%s".', $propertyName));;
    }
}
