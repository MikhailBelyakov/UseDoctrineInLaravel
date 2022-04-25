<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\Product;

use JetBrains\PhpStorm\Pure;
use Modules\Doctrine\Src\Entity\DatesColumnsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products",
 *  indexes={
 *     @ORM\Index(columns={"id"})
 * })
 */
class Product
{
    public const TABLE = 'products';

    /**
     * @ORM\Column(type="product_id")
     * @ORM\Id
     */
    private Id $id;

    /**
     * @var Name
     * @ORM\Embedded(class="Name", columnPrefix=false)
     */
    private Name $name;

    /**
     * @var Price
     * @ORM\Embedded(class="Price", columnPrefix=false)
     */
    private Price $price;

    /**
     * @var Sale
     * @ORM\Embedded(class="Sale", columnPrefix=false)
     */
    private Sale $sale;

    private function __construct(
        Id $id,
        Name $name,
        Price $price,
        Sale $sale
    )

    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->sale = $sale;
    }

    #[Pure] public static function createByAdmin(
        Id $id,
        Name $name,
        Price $price,
        Sale $sale
    ): self
    {
        return new self(
            $id,
            $name,
            $price,
            $sale,
        );
    }

    public function updateByAdmin(
        Name $name,
        Price $price,
        Sale $sale
    ): void
    {
        $this->name = $name;
        $this->price = $price;
        $this->sale = $sale;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getSale(): Sale
    {
        return $this->sale;
    }
}
