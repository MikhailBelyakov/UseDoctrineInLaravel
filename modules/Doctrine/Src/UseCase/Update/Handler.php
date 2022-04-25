<?php

namespace Modules\Doctrine\Src\UseCase\Update;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Modules\Doctrine\Infrastructure\Doctrine\Flusher;
use Modules\Doctrine\Src\Entity\Category\Exception\CategoryNotFoundException;
use Modules\Doctrine\Src\Entity\Product\Id;
use Modules\Doctrine\Src\Entity\Product\Name;
use Modules\Doctrine\Src\Entity\Product\Price;
use Modules\Doctrine\Src\Entity\Product\Product;
use Modules\Doctrine\Src\Entity\Product\Sale;
use Modules\Doctrine\Src\Entity\ProductCategory\ProductCategory;
use Modules\Doctrine\Src\Entity\ProductDescription\Exception\ProductDescriptionNotFoundException;
use Modules\Doctrine\Src\Entity\ProductDescription\ProductDescription;
use Modules\Doctrine\Src\Repository\Interfaces\CategoryRepositoryInterface;
use Modules\Doctrine\Src\Repository\Interfaces\ProductCategoryRepositoryInterface;
use Modules\Doctrine\Src\Repository\Interfaces\ProductDescriptionRepositoryInterface;
use Modules\Doctrine\Src\Repository\Interfaces\ProductRepositoryInterface;

class Handler
{
    public function __construct(
        private Flusher $flusher,
        private ProductRepositoryInterface $productRepository,
        private ProductDescriptionRepositoryInterface $descriptionRepository,
        private ProductCategoryRepositoryInterface $productCategoryRepository,
        private CategoryRepositoryInterface $categoryRepository,
    )
    {
    }

    /**
     * @param Command $command
     * @return void
     */
    public function execute(Command $command)
    {
        /**
         * @var Product|null $productForUpdate
         */
        // Поиск модели
        $productForUpdate = $this->productRepository->get(new Id($command->id));
        // Обновление модели
        $productForUpdate->updateByAdmin(
            new Name($command->name),
            new Price($command->price),
            new Sale($command->salePercent, $command->saleAmount, $command->saleTypeId)
        );

        try {
            // Поиск модели
            $productDescriptionForUpdate = $this->descriptionRepository->getByProduct(
                new \Modules\Doctrine\Src\Entity\ProductDescription\Product($command->id)
            );
            // Обновление модели
            $productDescriptionForUpdate->updateByProduct(
                $command->description,
                $command->shortDescription,
                $command->height,
                $command->length,
                $command->width,
                $command->weight
            );
        } catch (ProductDescriptionNotFoundException) {
            // Создание модели
            $productDescriptionForUpdate = ProductDescription::createWithProduct(
                new \Modules\Doctrine\Src\Entity\ProductDescription\Product($command->id),
                $command->description,
                $command->shortDescription,
                $command->height,
                $command->length,
                $command->width,
                $command->weight
            );
            // Регистрация новой модели
            $this->descriptionRepository->add($productDescriptionForUpdate);
        }

        foreach ($command->categories as $category) {
            try {
                // Поиск модели
                $category = $this->categoryRepository->get($category['id']);
                // Создание модели
                $productCategoryRelation = ProductCategory::createByProduct(
                    $productForUpdate->getId()->getValue(),
                    $category['id'],
                    $category['isSubCategory']
                );
                // Регистрация новой модели
                $this->productCategoryRepository->add($productCategoryRelation);
            } catch (CategoryNotFoundException) {
            }
        }
        // Транзакция всех измененных моделей
        $this->flusher->flush();
    }
}
