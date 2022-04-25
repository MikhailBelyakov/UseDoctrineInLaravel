<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Repository\Interfaces;

use Modules\Doctrine\Src\Entity\Category\Category;

interface CategoryRepositoryInterface
{
    public function get(int $id): Category;

    public function add(Category $entity): void;

    public function remove(Category $entity): void;
}
