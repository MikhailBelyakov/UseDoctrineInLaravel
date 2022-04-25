<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\ProductDescription;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Product
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private string $productId;

    public function __construct(string $productId)
    {
        $this->productId = $productId;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }
}
