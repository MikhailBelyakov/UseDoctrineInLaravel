<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Repository\Interfaces;

use Modules\Doctrine\Src\Entity\Product\Id;
use Modules\Doctrine\Src\Entity\ProductDescription\Product;
use Modules\Doctrine\Src\Entity\ProductDescription\ProductDescription;

interface ProductDescriptionRepositoryInterface
{
    public function getByProduct(Product $id): ProductDescription;

    public function get(int $id): ProductDescription;

    public function add(ProductDescription $entity): void;
}
