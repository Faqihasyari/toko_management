<?php

namespace App\Services;

use App\Repositories\MerchantProductRepository;
use App\Repositories\WarehouseProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use MerchantRepository;

class MerchantProductService
{
    private MerchantRepository $merchantRepository;

    private MerchantProductRepository $merchantProductRepository;
    private WarehouseProductRepository $warehouseProductRepository;

    public function __construct(MerchantProductRepository $merchantProductRepository, WarehouseProductRepository $warehouseProductRepository, MerchantRepository $merchantRepository)
    {
        $this->merchantProductRepository = $merchantProductRepository;
        $this->warehouseProductRepository = $warehouseProductRepository;
        $this->merchantRepository = $merchantRepository;
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

    public function removeProductFromMerchant(int $merchantId, int $productId)
{
    // $merchant = Merchant::findOrFail($merchantId);
    $merchant = $this->merchantRepository->getById($merchantId, $fields ?? ['*']);

    if (!$merchant) {
        throw ValidationException::withMessages([
            'product' => ['merchant not found.']
        ]);
    }

    $exists = $this->merchantProductRepository->getByMerchantAndProduct($merchantId, $productId);

    if (!$exists) {
        throw ValidationException::withMessages([
            'product' => ['Product not assigned to this merchant.']
        ]);
    }

    $merchant->products()->detach($productId);
}

}
