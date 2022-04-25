<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Modules\Doctrine\Src\Entity\Product\Enum\ProductSaleEnum;
use Modules\Doctrine\Src\Entity\Product\Exception\SaleTypeException;
use Modules\Doctrine\Src\Entity\Product\Exception\SaleValueException;

/**
 * @ORM\Embeddable
 */
class Sale
{
    /**
     * @var float
     * @ORM\Column(type="float", nullable=false)
     */
    private float $salePercent;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=false)
     */
    private float $saleAmount;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $saleTypeId;

    public function __construct(float $salePercent, float $saleAmount, int $saleTypeId)
    {
        try {
            ProductSaleEnum::from($saleTypeId);
        } catch (\ValueError) {
            throw new SaleTypeException();
        }

        if ($salePercent < 0 || $saleAmount < 0) {
            throw new SaleValueException();
        }

        $this->salePercent = $salePercent;
        $this->saleAmount = $saleAmount;
        $this->saleTypeId = $saleTypeId;
    }

    public function getSalePercent(): float
    {
        return $this->salePercent;
    }

    public function getSaleAmount(): float
    {
        return $this->saleAmount;
    }

    public function getSaleType(): float
    {
        return $this->saleTypeId;
    }
}
