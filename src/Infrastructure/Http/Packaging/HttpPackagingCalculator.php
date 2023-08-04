<?php

namespace App\Infrastructure\Http\Packaging;

use App\DomainModel\Packaging;
use App\DomainModel\Packaging\PackagingCalculator;
use App\DomainModel\Packaging\PackagingCalculator\Exceptions\CouldNotResolvePackagingException;
use App\DomainModel\Packaging\PackagingCalculator\VOs\Request;

final class HttpPackagingCalculator implements PackagingCalculator
{
    public function __construct(Client) {

    }

    function resolve(Request $request): Packaging
    {
        // TODO: implement
        throw new CouldNotResolvePackagingException($request);
    }
}
