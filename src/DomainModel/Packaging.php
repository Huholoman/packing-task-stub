<?php

namespace App\DomainModel;

readonly class Packaging
{
    public function __construct(
        public int $id,
        public float $width,
        public float $height,
        public float $length,
        public float $maxWeight,
    ) {}
}
