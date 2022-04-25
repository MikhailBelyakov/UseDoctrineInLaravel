<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectRepository;
use Modules\Doctrine\Src\Entity\Product\Id;
use Modules\Doctrine\Src\Entity\ProductDescription\Exception\ProductDescriptionNotFoundException;
use Modules\Doctrine\Src\Entity\ProductDescription\Product;
use Modules\Doctrine\Src\Entity\ProductDescription\ProductDescription;
use Modules\Doctrine\Src\Repository\Interfaces\ProductDescriptionRepositoryInterface;

class ProductDescriptionRepository implements ProductDescriptionRepositoryInterface
{
    private ObjectRepository $repository;
    private EntityManager $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository(ProductDescription::class);
        $this->entityManager = $em;
    }

    public function get(int $id): ProductDescription
    {
        if (!$entity = $this->repository->find($id)) {
            throw new ProductDescriptionNotFoundException('Описание продукта не найдено.');
        }
        return $entity;
    }

    public function add(ProductDescription $entity): void
    {
        $this->entityManager->persist($entity);
    }

    public function getByProduct(Product $id): ProductDescription
    {
        if (!$entity = $this->repository->find($id->getProductId())) {
            throw new ProductDescriptionNotFoundException('Описание продукта не найдено.');
        }
        return $entity;
    }
}
