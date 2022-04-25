<?php

declare(strict_types=1);

namespace Modules\Doctrine\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;

class Flusher
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function flush(): void
    {
        $this->em->flush();
    }
}
