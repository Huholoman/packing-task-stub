<?php

namespace App\DomainModel\Packaging\PackagingCalculator;

use App\DomainModel\Packaging;
use App\DomainModel\Packaging\PackagingCalculator;
use App\DomainModel\Packaging\PackagingCalculator\Exceptions\CouldNotResolvePackagingException;
use App\DomainModel\Packaging\PackagingCalculator\VOs\Request;

final class FallbackPackagingCalculator implements PackagingCalculator
{
    function resolve(Request $request): Packaging
    {
        throw new CouldNotResolvePackagingException();
    }
}
