<?php

namespace Tests\Unit;

use Modules\Doctrine\App\Service\ProductService;
use PHPUnit\Framework\TestCase;

final class CreateProductTest extends TestCase
{

    public function testSuccessDataRequest()
    {
        $productService = app(ProductService::class);
        $productService->create([
                'name',
                100,
                30,
                300,
                1,
                'description',
                'shortDescription',
                100,
                200,
                300,
                40,
                [
                    ['id' => 1, 'isSubCategory' => false],
                    ['id' => 2, 'isSubCategory' => true],
                    ['id' => 3, 'isSubCategory' => false]
                ],
            ]
        );
    }


       public function testErrorDataRequestTest()
        {
            $productService = app(ProductService::class);
            $productService->create([
                    'name',
                    'name',
                    30,
                    300,
                    1,
                    'description',
                    'shortDescription',
                    100,
                    200,
                    300,
                    40,
                    [
                        ['id' => 1, 'isSubCategory' => false],
                        ['id' => 2, 'isSubCategory' => true],
                        ['id' => 3, 'isSubCategory' => false]
                    ],
                ]
            );
            $this->expectException(\DomainException::class);
        }
}
