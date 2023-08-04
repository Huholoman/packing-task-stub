<?php

namespace App\Infrastructure\Http\Endpoints\Factories\Exceptions;

final class InvalidPropertyTypeException extends InvalidRequestException
{
    private function __construct(string $propertyName, string $expectedType, mixed $actualValue)
    {
        parent::__construct(sprintf(
            'Type of property "%s" is expected to be "%s", given "%s".',
            $propertyName,
            $expectedType,
            gettype($actualValue),
        ));
    }

    public static function expectedInt(string $propertyName, mixed $actualValue): self {
        return new self($propertyName, 'int', $actualValue);
    }

    public static function expectedFloat(string $propertyName, mixed $actualValue): self {
        return new self($propertyName, 'float', $actualValue);
    }
}
