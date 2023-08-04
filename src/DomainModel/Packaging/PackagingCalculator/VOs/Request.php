<?php

namespace App\DomainModel\Packaging\PackagingCalculator\VOs;

use App\DomainModel\Packaging\PackagingCalculator\Exceptions\EmptyBoxesException;
use App\DomainModel\Packaging\PackagingCalculator\VOs\Request\Box;

final readonly class Request
{
    /**
     * @param list<Box> $boxes
     */
    public function __construct(
        public array $boxes
    ) {}

    /**
     * @throws EmptyBoxesException
     */
    public static function fromBoxes(Box ...$boxes): self {
        if (count($boxes) < 1) {
            throw new EmptyBoxesException();
        }

        return new self($boxes);
    }
}
