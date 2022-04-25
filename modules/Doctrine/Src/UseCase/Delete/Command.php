<?php

namespace Modules\Doctrine\Src\UseCase\Delete;

class Command
{
    public function __construct(
        public string $id
    )
    {
    }
}
