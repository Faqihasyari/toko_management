<?php

namespace App\Services;

use App\Repositories\MerchantProductRepository;
use App\Repositories\WarehouseProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MerchantProductService
{
    private MerchantProductRepository $merchantProductRepository;
    private WarehouseProductRepository $warehouseProductRepository;

    public function __construct(MerchantProductRepository $merchantProductRepository, WarehouseProductRepository $warehouseProductRepository)
    {
        $this->merchantProductRepository = $merchantProductRepository;
        $this->warehouseProductRepository = $warehouseProductRepository;
    }

    public function assignProductToMerchant(array $data)
    {
        return DB::transaction(function () use ($data) {
            $warehouseProduct = $this->warehouseProductRepository->getByWarehouseAndProduct(
                $data['warehouse_id'],
                $data['product_id']
            );

            if (!$warehouseProduct || $warehouseProduct->stock < $data['stock']) {
                throw ValidationException::withMessages([
                    'stock' => ['Insufficient stock in warehouse.']
                ]);
            }

            $existingProduct = $this->merchantProductRepository->getByMerchantAndProduct(
                $data['merchant_id'],
                $data['product_id']
            );

            if ($existingProduct) {
                throw ValidationException::withMessages([
                    'product' => ['Product already exist in this merchant.']
                ]);
            }

            //kurangi stock pada warehouse
            $this->warehouseProductRepository->updateStock(
                $data['warehouse_id'],
                $data['product_id'],
                $warehouseProduct->stock - $data['stock']
            );
        });
    }
}
