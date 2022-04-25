<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\Category;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Description
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
