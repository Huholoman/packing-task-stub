<?php

namespace App\DomainModel\Packaging\PackagingCalculator;

use App\DomainModel\Packaging;
use App\DomainModel\Packaging\PackagingCalculator;
use App\DomainModel\Packaging\PackagingCalculator\Exceptions\CouldNotResolvePackagingException;
use App\DomainModel\Packaging\PackagingCalculator\Exceptions\EmptyPackagingCalculatorsException;
use App\DomainModel\Packaging\PackagingCalculator\VOs\Request;

// TODO: find better name
final class SuperPackagingCalculator implements PackagingCalculator
{
    /**
     * @param list<PackagingCalculator> $calculators
     *
     * @throws EmptyPackagingCalculatorsException
     */
    public function __construct(
        private readonly array $calculators,
    ) {
        if (count($this->calculators) === 0) {
            throw new EmptyPackagingCalculatorsException();
        }
    }

    function resolve(Request $request): Packaging
    {
        // TODO: there is a bit problem with handling original calculator exception

        foreach ($this->calculators as $calculator) {
            try {
                return $calculator->resolve($request);
            } catch (CouldNotResolvePackagingException $e) {
            }
        }

        throw new CouldNotResolvePackagingException($request, $e);
    }
}
