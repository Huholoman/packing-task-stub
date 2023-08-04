<?php

namespace App\DomainModel\Packaging\PackagingCalculator\Exceptions;

use Exception;

final class EmptyPackagingCalculatorsException extends Exception
{
    public function __construct()
    {
        parent::__construct('Expected array of at least 1 PackagingCalculator, but empty array was given.');
    }
}
