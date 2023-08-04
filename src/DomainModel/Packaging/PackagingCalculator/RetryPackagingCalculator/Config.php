<?php

namespace App\DomainModel\Packaging\PackagingCalculator\RetryPackagingCalculator;

readonly class Config
{
    public function __construct(
        public int $maxRetries,
    ) {}
}
