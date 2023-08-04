<?php

namespace App\Infrastructure\Doctrine\Packaging;

use App\DomainModel;
use App\DomainModel\Packaging\PackagingRepository;
use App\Infrastructure\Doctrine\Entity\Packaging;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class DoctrinePackagingRepository implements PackagingRepository
{
    /**
     * @var EntityRepository<Packaging>
     */
    private readonly EntityRepository $repository;

    public function __construct(
        private readonly EntityManager $entityManager,
    ) {
        $this->repository = $this->entityManager->getRepository(Packaging::class);
    }

    public function create(DomainModel\Packaging $packaging): void
    {
        $entity = new Packaging();
    }
}
