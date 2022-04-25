<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\Category;

use Modules\Doctrine\Src\Entity\DatesColumnsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories",
 *  indexes={
 *     @ORM\Index(columns={"id"})
 * }  )
 */
class Category
{
    use DatesColumnsTrait;

    public const TABLE = 'categories';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private int $id;

    /**
     * @var Name
     * @ORM\Embedded(class="Name", columnPrefix=false)
     */
    private Name $name;

    /**
     * @var Description
     * @ORM\Embedded(class="Description", columnPrefix=false)
     */
    private Description $description;


    private function __construct(
        Name $name,
        Description $description,
    )
    {
        $this->name = $name;
        $this->description = $description;
    }
}
