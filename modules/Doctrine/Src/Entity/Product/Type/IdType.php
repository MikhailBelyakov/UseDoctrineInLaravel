<?php

declare(strict_types=1);

namespace Modules\Doctrine\Src\Entity\Product\Type;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use JetBrains\PhpStorm\Pure;
use Modules\Doctrine\Src\Entity\Product\Id;

class IdType extends GuidType
{
    public const NAME = 'product_id';

    #[Pure] public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Id ? $value->getValue() : $value;
    }

    #[Pure] public function convertToPHPValue($value, AbstractPlatform $platform): ?Id
    {
        return !empty($value) ? new Id($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
