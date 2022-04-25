<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Modules\Doctrine\Src\Entity\ProductCategory\ProductCategory;
use Modules\Doctrine\Src\Repository\Interfaces\ProductCategoryRepositoryInterface;

class ProductCategoryRepository implements ProductCategoryRepositoryInterface
{
    private ObjectRepository $repository;
    private EntityManager $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository(ProductCategory::class);
        $this->entityManager = $em;
    }

    public function add(ProductCategory $entity): void
    {
        $this->entityManager->persist($entity);
    }

    public function remove(ProductCategory $entity): void
    {
        $this->entityManager->remove($entity);
    }
}
