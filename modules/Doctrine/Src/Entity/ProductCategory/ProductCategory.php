<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\ProductCategory;

use Modules\Doctrine\Src\Entity\DatesColumnsTrait;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="products_to_categories",
 *  indexes={
 *     @ORM\Index(columns={"product_id"}),
 *     @ORM\Index(columns={"category_id"})
 * } )
 */
class ProductCategory
{
    use DatesColumnsTrait;

    public const TABLE = 'products_to_categories';

    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private string $productId;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private int $categoryId;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private bool $isSubCategory;

    private function __construct(
        string $productId,
        int $categoryId,
        bool $isSubCategory,
    )
    {
        $this->productId = $productId;
        $this->categoryId = $categoryId;
        $this->isSubCategory = $isSubCategory;
    }

    #[Pure] public static function createByProduct(
        string $productId,
        int $categoryId,
        bool $isSubCategory,
    ): self
    {
        return new self(
            $productId,
            $categoryId,
            $isSubCategory,
        );
    }
}
