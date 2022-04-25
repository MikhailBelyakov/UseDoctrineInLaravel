<?php

namespace Modules\Doctrine\Src\UseCase\Update;

class Command
{
    public function __construct(
        public string $id,
        public string $name,
        public float $price,
        public float $salePercent,
        public float $saleAmount,
        public int $saleTypeId,
        public int $description,
        public int $shortDescription,
        public int $height,
        public int $length,
        public int $width,
        public int $weight,
        public array $categories = [
            ['id' => 1, 'isSubCategory' => false],
            ['id' => 2, 'isSubCategory' => true],
            ['id' => 3, 'isSubCategory' => false]
        ],
    )
    {

    }
}
