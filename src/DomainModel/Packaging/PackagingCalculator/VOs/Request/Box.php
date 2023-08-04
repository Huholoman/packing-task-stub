<?php

namespace App\DomainModel\Packaging\PackagingCalculator\VOs\Request;

use Exception;

final readonly class Box
{

    private function __construct(
        public int $id,
        public float $width,
        public float $height,
        public float $length,
        public float $weight,
    ) {}

    public static function fromValues(int $id, float $width, float $height, float $length, float $weight): self
    {
        // TODO: specific exceptions
        if ($id < 0) {
            throw new Exception("invalid id");
        }

        if ($width <= 0) {
            throw new Exception("invalid width");
        }

        if ($height <= 0) {
            throw new Exception("invalid height");
        }

        if ($length <= 0) {
            throw new Exception("invalid length");
        }

        if ($length <= $weight) {
            throw new Exception("invalid weidhgt");
        }

        return new self($id, $weight, $height, $length, $weight);
    }
}
