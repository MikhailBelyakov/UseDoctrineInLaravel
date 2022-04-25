<?php

namespace Modules\Doctrine\Src\UseCase\Delete;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Modules\Doctrine\Src\Entity\Product\Exception\ProductNotFoundException;
use Modules\Doctrine\Src\Entity\Product\Product;
use Modules\Doctrine\Src\Entity\ProductCategory\ProductCategory;
use Modules\Doctrine\Src\Entity\ProductDescription\ProductDescription;

class Handler
{
    public function __construct(
        private EntityManager $entityManager)
    {
    }

    /**
     * @param Command $command
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function execute(Command $command)
    {
        /**
         * @var Product|null $product
         */
        // Получение репозитория и поиск модели
        $productRepository = $this->entityManager->getRepository(Product::class);
        $product = $productRepository->findOneBy(['id' => $command->id]);

        if ($product === null) {
            throw new  ProductNotFoundException();
        }
        // Регистрации удаления модели
        $this->entityManager->remove($product);

        /**
         * @var ProductDescription|null $productDescription
         */
        // Получение репозитория и поиск модели
        $productDescriptionRepository = $this->entityManager->getRepository(ProductDescription::class);
        $productDescription = $productDescriptionRepository->findOneBy(['productId' => $command->id]);

        if ($productDescription !== null) {
            // Регистрации удаления модели
            $this->entityManager->remove($productDescription);
        }
        // Получение репозитория и поиск модели
        $productCategoryRepository = $this->entityManager->getRepository(ProductCategory::class);
        $productCategories = $productCategoryRepository->findBy(['productId' => $command->id]);

        foreach ($productCategories as $productCategory) {
            // Регистрации удаления модели
            $this->entityManager->remove($productCategory);
        }
        // Транзакция всех измененных моделей
        $this->entityManager->flush();
    }
}
