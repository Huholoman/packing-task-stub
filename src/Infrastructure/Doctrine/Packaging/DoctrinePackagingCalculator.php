<?php

namespace App\Infrastructure\Doctrine\Packaging;

use App\DomainModel;
use App\DomainModel\Packaging\PackagingCalculator;
use App\DomainModel\Packaging\PackagingCalculator\Exceptions\CouldNotResolvePackagingException;
use App\DomainModel\Packaging\PackagingCalculator\VOs\Request;
use App\Infrastructure\Doctrine\Entity\Packaging;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

final class DoctrinePackagingCalculator implements PackagingCalculator
{
    /**
     * @var EntityRepository<Packaging>
     */
    private EntityRepository $repository;

    public function __construct(
        private EntityManager $entityManager,
    ) {
        $this->repository = $this->entityManager->getRepository(Packaging::class);
    }

    function resolve(Request $request): DomainModel\Packaging
    {
        // todo
        throw new CouldNotResolvePackagingException();
    }
}
