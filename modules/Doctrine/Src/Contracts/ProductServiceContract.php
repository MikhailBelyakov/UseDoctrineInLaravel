<?php
namespace Modules\Doctrine\Src\Contracts;

interface ProductServiceContract
{
    public function create(array $productDto): void;

    public function update(string $id, array $productDto): void;

    public function delete(string $id): void;
}
