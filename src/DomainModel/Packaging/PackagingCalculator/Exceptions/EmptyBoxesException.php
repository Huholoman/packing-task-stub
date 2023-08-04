<?php

namespace App\DomainModel\Packaging\PackagingCalculator\Exceptions;

use Exception;

final class EmptyBoxesException extends Exception
{
    public function __construct()
    {
        parent::__construct('');
    }
}
