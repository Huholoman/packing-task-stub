<?php

namespace App\DomainModel\Packaging;

use App\DomainModel\Packaging;
use App\DomainModel\Packaging\PackagingCalculator\Exceptions\CouldNotResolvePackagingException;
use App\DomainModel\Packaging\PackagingCalculator\VOs\Request;

interface PackagingCalculator
{
    /**
     * @throws CouldNotResolvePackagingException
     */
    function resolve(Request $request): Packaging;
}
