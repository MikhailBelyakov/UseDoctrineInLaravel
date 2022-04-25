<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\Product\Exception;

use Throwable;

class SaleValueException extends \DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Скидка не может быть отрицательной', $code, $previous);
    }
}
