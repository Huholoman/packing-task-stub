<?php

namespace App\DomainModel\Packaging\PackagingCalculator\Exceptions;

use App\DomainModel\Packaging\PackagingCalculator\VOs\Request;
use App\DomainModel\Packaging\PackagingCalculator\VOs\Request\Box;
use Exception;
use Throwable;

final class CouldNotResolvePackagingException extends Exception
{
    public function __construct(Request $request, ?Throwable $previous = null)
    {
        $boxDimensionStrings = array_map(fn (Box $box) => sprintf(
            "%fx%fx%f with weight %f",
            $box->width,
            $box->height,
            $box->length,
            $box->weight,
        ), $request->boxes);

        $boxDimensionsString = implode(',', $boxDimensionStrings);

        $message = sprintf("Could not resolve packaging for given boxes: %s", $boxDimensionsString);

        parent::__construct($message, 0, $previous);
    }
}
