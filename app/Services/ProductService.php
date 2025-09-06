<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll(int $id, array $fields)
    {
        return $this->productRepository->getAll($fields);
    }

    public function getById(int $id, array $fields)
    {
        return $this->productRepository->getById($id, $fields ?? ['*']);
    }
}
