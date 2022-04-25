<?php

namespace Modules\Doctrine\App\Service;

use Modules\Doctrine\Src\Contracts\ProductServiceContract;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Modules\Doctrine\Src\UseCase\Create\{
    Handler as CreateHandler,
    Command as CreateCommand
};
use Modules\Doctrine\Src\UseCase\Update\{
    Handler as UpdateHandler,
    Command as UpdateCommand
};
use Modules\Doctrine\Src\UseCase\Delete\{
    Handler as DeleteHandler,
    Command as DeleteCommand
};

class ProductService implements ProductServiceContract
{
    public function __construct(
        private CreateHandler $createHandler,
        private UpdateHandler $updateHandler,
        private DeleteHandler $deleteHandler,
    )
    {
    }

    /**
     * @param $productDto
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create($productDto): void
    {

        try {
            $command = new CreateCommand(
                $productDto['name'],
                $productDto['price'],
                $productDto['salePercent'],
                $productDto['saleAmount'],
                $productDto['saleTypeId'],
                $productDto['description'],
                $productDto['shortDescription'],
                $productDto['height'],
                $productDto['length'],
                $productDto['width'],
                $productDto['weight'],
                $productDto['categories'],
            );
        } catch (\Throwable) {
            throw new \DomainException('Ошибка заполнения данных');
        }

        $this->createHandler->execute($command);
    }

    /**
     * @param string $id
     * @param array $productDto
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(string $id, array $productDto): void
    {
        try {
            $command = new UpdateCommand(
                $id,
                $productDto['name'],
                $productDto['price'],
                $productDto['salePercent'],
                $productDto['saleAmount'],
                $productDto['saleTypeId'],
                $productDto['description'],
                $productDto['shortDescription'],
                $productDto['height'],
                $productDto['length'],
                $productDto['width'],
                $productDto['weight'],
                $productDto['categories'],
            );
        } catch (\Throwable) {
            throw new \DomainException('Ошибка заполнения данных');
        }
        $this->updateHandler->execute($command);
    }

    /**
     * @param string $id
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(string $id): void
    {
        $this->deleteHandler->execute(new DeleteCommand($id));
    }
}
