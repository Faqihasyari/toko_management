<?php

namespace App\Services;

use App\Repositories\MerchantProductRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TransactionRepositor;
use MerchantRepository;

class TransactionService
{
    private TransactionRepositor $transactionRepository;
    private MerchantProductRepository $merchantProductRepository;
    private ProductRepository $productRepository;
    private MerchantRepository $merchantRepository;

    public function __construct(
        TransactionRepositor $transactionRepository,
        MerchantProductRepository $merchantProductRepository,
        ProductRepository $productRepository,
        MerchantRepository $merchantRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->merchantProductRepository = $merchantProductRepository;
        $this->productRepository = $productRepository;
        $this->merchantRepository = $merchantRepository;
    }

    public function getAll(array $fields)
    {
        return $this->transactionRepository->getAll($fields);
    }
}
