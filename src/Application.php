<?php

namespace App;

use App\DomainModel\Packaging\PackagingCalculator;
use App\DomainModel\Packaging\PackagingCalculator\Exceptions\CouldNotResolvePackagingException;
use App\DomainModel\Packaging\PackagingCalculator\Exceptions\EmptyBoxesException;
use App\Infrastructure\Http\Endpoints\Factories\PackagingCalculatorRequestFactory;
use App\Infrastructure\Http\Endpoints\Factories\Exceptions\InvalidRequestException;
use App\Infrastructure\Http\Endpoints\Factories\PackagingResponseFactory;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Application
{

    public function __construct(
        private readonly PackagingCalculator               $packagingCalculator,
        private readonly PackagingCalculatorRequestFactory $packagingCalculatorRequestFactory,
        private readonly PackagingResponseFactory          $packagingResponseFactory,
    ) {}

    public function run(RequestInterface $request): ResponseInterface
    {
        try {
            $packagingCalculatorRequest = $this->packagingCalculatorRequestFactory->create($request->getBody());
            $packaging = $this->packagingCalculator->resolve($packagingCalculatorRequest);
            $response = $this->packagingResponseFactory->create($packaging);

            return new Response(200, ['Content-Type' => 'application/json'], $response);
        } catch (InvalidRequestException|CouldNotResolvePackagingException|EmptyBoxesException $e) {
            return new Response(400, ['Content-Type' => 'application/problem+json'], $e->getMessage());
        }
    }

}
