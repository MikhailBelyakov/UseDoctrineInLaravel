<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Repository;

use Modules\Doctrine\Src\Entity\Product\Exception\ProductNotFoundException;
use Modules\Doctrine\Src\Entity\Product\Id;
use Modules\Doctrine\Src\Entity\Product\Product;
use Modules\Doctrine\Src\Repository\Interfaces\ProductRepositoryInterface;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;

class ProductRepository implements ProductRepositoryInterface
{
    private ObjectRepository $repository;
    private EntityManager $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository(Product::class);
        $this->entityManager = $em;
    }

    public function get(Id $id): Product
    {
        if (!$entity = $this->repository->find($id->getValue())) {
            throw new ProductNotFoundException();
        }
        return $entity;
    }

    /**
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function add(Product $entity): void
    {
        $this->entityManager->persist($entity);
    }

    /**
     * @param Product $entity
     * @return void
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function remove(Product $entity): void
    {
        $this->entityManager->remove($entity);
    }
}
