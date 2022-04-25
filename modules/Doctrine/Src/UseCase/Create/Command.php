<?php

namespace Modules\Doctrine\Src\UseCase\Create;


class Command
{
    public function __construct(
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
        public array $categories,
    )
    {
    }
}
