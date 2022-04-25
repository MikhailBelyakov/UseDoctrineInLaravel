<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\Product\Exception;

use Throwable;

class SaleTypeException extends \DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Неверное значение типа скидки', $code, $previous);
    }
}
