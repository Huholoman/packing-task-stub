<?php

namespace App\DomainModel\Packaging\PackagingCalculator;

use App\DomainModel\Packaging;
use App\DomainModel\Packaging\PackagingCalculator;
use App\DomainModel\Packaging\PackagingCalculator\RetryPackagingCalculator\Config;
use App\DomainModel\Packaging\PackagingCalculator\VOs\Request;
use Exception;

final class RetryPackagingCalculator implements PackagingCalculator
{
    public function __construct(
        private readonly PackagingCalculator $calculator,
        private readonly Config $config,
    ) {}

    function resolve(Request $request): Packaging
    {
        $iteration = 1;
        while (true) {
            try {
                return $this->calculator->resolve($request);
            } catch (Exception $e) {
                if ($iteration > $this->config->maxRetries) {
                    throw $e;
                }
            }
            $iteration++;
        }
    }
}
