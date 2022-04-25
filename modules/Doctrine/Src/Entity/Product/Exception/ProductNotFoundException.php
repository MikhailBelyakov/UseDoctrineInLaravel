<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\Product\Exception;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class ProductNotFoundException extends \DomainException
{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct('Продукт не найден.', $code, $previous);
    }
}
