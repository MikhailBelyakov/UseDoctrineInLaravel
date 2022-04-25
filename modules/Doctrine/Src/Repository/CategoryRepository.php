<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Modules\Doctrine\Src\Entity\Category\Exception\CategoryNotFoundException;
use Modules\Doctrine\Src\Entity\Category\Category;
use Modules\Doctrine\Src\Repository\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    private ObjectRepository $repository;
    private EntityManager $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository(Category::class);
        $this->entityManager = $em;
    }

    public function get(int $id): Category
    {
        if (!$entity = $this->repository->find($id)) {
            throw new CategoryNotFoundException('Категория не найдена.');
        }
        return $entity;
    }

    public function add(Category $entity): void
    {
        $this->entityManager->persist($entity);
    }

    public function remove(Category $entity): void
    {
        $this->entityManager->remove($entity);
    }
}
