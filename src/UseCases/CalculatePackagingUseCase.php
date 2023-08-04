<?php

namespace App\UseCases;

use App\DomainModel\Packaging;
use App\DomainModel\Packaging\PackagingCalculator;

final class CalculatePackagingUseCase
{
    public function __construct(
        private readonly PackagingCalculator $calculator,
    ) {}

    // TODO: throw the use case away ...i guess
    public function do(Request $request): Packaging
    {
        return $this->calculator->resolve($request);
    }
}
