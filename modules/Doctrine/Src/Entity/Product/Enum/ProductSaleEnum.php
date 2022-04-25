<?php

namespace Modules\Doctrine\Src\Entity\Product\Enum;

enum ProductSaleEnum: int
{
    case NotSelected = 0;
    case Percent = 1;
    case Amount = 2;
}
