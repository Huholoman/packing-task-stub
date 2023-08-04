<?php

use App\Application;
use App\DomainModel\Packaging\PackagingCalculator\FallbackPackagingCalculator;
use App\DomainModel\Packaging\PackagingCalculator\RetryPackagingCalculator;
use App\DomainModel\Packaging\PackagingCalculator\SuperPackagingCalculator;
use App\Infrastructure\Doctrine\Packaging\DoctrinePackagingCalculator;
use App\Infrastructure\Http\Endpoints\Factories\PackagingCalculatorRequestFactory;
use App\Infrastructure\Http\Endpoints\Factories\PackagingResponseFactory;
use App\Infrastructure\Http\Packaging\HttpPackagingCalculator;
use App\UseCases\CalculatePackagingUseCase;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;

require __DIR__ . '/../vendor/autoload.php';

$config = ORMSetup::createAttributeMetadataConfiguration([__DIR__], true);
$config->setNamingStrategy(new UnderscoreNamingStrategy());

$entityManager = EntityManager::create([
    'driver' => 'pdo_mysql',
    'host' => 'shipmonk-packing-mysql',
    'user' => 'root',
    'password' => 'secret',
    'dbname' => 'packing',
], $config);

$doctrinePackagingCalculator = new DoctrinePackagingCalculator($entityManager);
$httpPackagingCalculator = new HttpPackagingCalculator();
$retryPackagingCalculator = new RetryPackagingCalculator(
    $httpPackagingCalculator, new RetryPackagingCalculator\Config(3),
);
$fallbackPackagingCalculator = new FallbackPackagingCalculator();

$packagingCalculator = new SuperPackagingCalculator([
    $doctrinePackagingCalculator,
    $retryPackagingCalculator,
    $fallbackPackagingCalculator,
]);

$calculatePackagingUseCase = new CalculatePackagingUseCase($packagingCalculator);

$packagingCalculatorRequestFactory = new PackagingCalculatorRequestFactory();
$packagingResponseFactory = new PackagingResponseFactory();

return new Application(
    $calculatePackagingUseCase,
    $packagingCalculatorRequestFactory,
    $packagingResponseFactory,
);
