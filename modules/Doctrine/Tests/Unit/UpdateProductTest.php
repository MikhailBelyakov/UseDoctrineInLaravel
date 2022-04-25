<?php

namespace Tests\Unit;

use App\Service\Interface\ProductServiceInterface;
use App\Service\ProductService;
use PHPUnit\Framework\TestCase;

final class UpdateProductTest extends TestCase
{

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function testSuccessDataRequest()
    {
        $productService = $this->getMockBuilder(ProductService::class)
        ->setConstructorArgs(array())
        ->setMockClassName(ProductService::class)
        // отключив вызов конструктора, можно получить Mock объект "одиночки"
        ->disableOriginalConstructor()
        ->disableOriginalClone()
        ->disableAutoload()
        ->getMock();

        $productService->update(
            1,
            [
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

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function testErrorDataRequestTest(ProductService $productService)
    {

        $productService->update(
            1,
            [
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

    public function notFoundEntityTest()
    {

    }
}