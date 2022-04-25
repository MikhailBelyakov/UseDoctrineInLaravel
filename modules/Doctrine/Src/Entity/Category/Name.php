<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\Category;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Name
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
