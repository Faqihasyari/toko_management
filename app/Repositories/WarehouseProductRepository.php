<?php

namespace App\Repositories;

use App\Models\WarehouseProduct;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class WarehouseProductRepository
{

    public function getByWarehouseAndProduct($warehouseId, $productId)
    {
        return WarehouseProduct::where('warehouse_id', $warehouseId)
            ->where('product_id', $productId)
            ->first();
    }

    public function updateStock($warehouseId, $productId, $stock)
    {
        $warehouseProduct = $this->getByWarehouseAndProduct($warehouseId, $productId);

        if (!$warehouseProduct) {
            throw ValidationException::withMessages([
                'error' => 'Product not found for this warehouse.',
            ]);
        }

        $warehouseProduct->update(['stock' => $stock]);

        return $warehouseProduct;
    }
}
