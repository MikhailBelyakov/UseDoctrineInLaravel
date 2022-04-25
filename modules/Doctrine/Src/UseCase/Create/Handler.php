<?php

namespace Modules\Doctrine\Src\UseCase\Create;


use Modules\Doctrine\Infrastructure\Doctrine\Flusher;
use Modules\Doctrine\Src\Entity\Category\Exception\CategoryNotFoundException;
use Modules\Doctrine\Src\Entity\Product\Id;
use Modules\Doctrine\Src\Entity\Product\Name;
use Modules\Doctrine\Src\Entity\Product\Price;
use Modules\Doctrine\Src\Entity\Product\Product;
use Modules\Doctrine\Src\Entity\Product\Sale;
use Modules\Doctrine\Src\Entity\ProductCategory\ProductCategory;
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
        // Создание модели
        $product = Product::createByAdmin(
            $productId = Id::next(),
            new Name($command->name),
            new Price($command->price),
            new Sale($command->salePercent, $command->saleAmount, $command->saleTypeId)
        );
        // Регистрация новой модели
        $this->productRepository->add($product);

        // Создание модели
        $productDescription = ProductDescription::createWithProduct(
            new \Modules\Doctrine\Src\Entity\ProductDescription\Product($productId->getValue()),
            $command->description,
            $command->shortDescription,
            $command->height,
            $command->length,
            $command->width,
            $command->weight
        );
        // Регистрация новой модели
        $this->descriptionRepository->add($productDescription);


        foreach ($command->categories as $category) {
            // Поиск модели
            try {
                $category = $this->categoryRepository->get($category['id']);
                // Создание модели
                $productCategory = ProductCategory::createByProduct(
                    $productId,
                    $category['id'],
                    $category['isSubCategory']
                );
                // Регистрация новой модели
                $this->productCategoryRepository->add($productCategory);
            } catch (CategoryNotFoundException) {

            }
        }
        // Транзакция всех измененных моделей
        $this->flusher->flush();
    }
}
