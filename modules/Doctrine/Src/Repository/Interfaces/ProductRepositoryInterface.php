<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Repository\Interfaces;

use Modules\Doctrine\Src\Entity\Product\Id;
use Modules\Doctrine\Src\Entity\Product\Product;

interface ProductRepositoryInterface
{
    public function get(Id $id): Product;

    public function add(Product $entity): void;

    public function remove(Product $entity): void;
}
