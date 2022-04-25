<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Repository\Interfaces;

use Modules\Doctrine\Src\Entity\ProductCategory\ProductCategory;

interface ProductCategoryRepositoryInterface
{
    public function add(ProductCategory $entity): void;

    public function remove(ProductCategory $entity): void;
}
