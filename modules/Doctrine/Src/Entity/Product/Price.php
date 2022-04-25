<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Price
{
    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $price;

    public function __construct(float $price)
    {
        if ($price < 0) {
            throw new \DomainException('Цена не может быть отрицательной');
        }

        $this->price = $price * 100;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return (float)$this->price / 100;
    }
}
