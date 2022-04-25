<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\ProductDescription;

use Modules\Doctrine\Src\Entity\DatesColumnsTrait;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="product_descriptions",
 *  indexes={
 *     @ORM\Index(columns={"product_id"})
 * }  )
 */
class ProductDescription
{
    use DatesColumnsTrait;

    public const TABLE = 'product_descriptions';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @var Product
     * @ORM\Embedded(class="Product", columnPrefix=false)
     */
    private Product $product;
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private string $description;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private string $shortDescription;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private float $height;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private float $length;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private float $width;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private float $weight;


    private function __construct(
        Product $product,
        string $description,
        string $shortDescription,
        float $height,
        float $length,
        float $width,
        float $weight
    )
    {
        $this->product = $product;
        $this->description = $description;
        $this->shortDescription = $shortDescription;
        $this->height = $height;
        $this->length = $length;
        $this->width = $width;
        $this->weight = $weight;
    }

    #[Pure] public static function createWithProduct(
        Product $product,
        string $description,
        string $shortDescription,
        float $height,
        float $length,
        float $width,
        float $weight
    ): self
    {
        return new self(
            $product,
            $description,
            $shortDescription,
            $height,
            $length,
            $width,
            $weight
        );
    }

    public function updateByProduct(
        string $description,
        string $shortDescription,
        float $height,
        float $length,
        float $width,
        float $weight
    ): void
    {
        $this->description = $description;
        $this->shortDescription = $shortDescription;
        $this->height = $height;
        $this->length = $length;
        $this->width = $width;
        $this->weight = $weight;
    }
}
