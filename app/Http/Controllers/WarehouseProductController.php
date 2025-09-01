<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseProductRequest;
use App\Http\Requests\WarehouseProductUpdateRequest;
use App\Services\WarehouseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WarehouseProductController
{
    //

    private WarehouseService $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function attach(WarehouseProductRequest $request, int $warehouseId): JsonResponse
    {


        $this->warehouseService->attachProduct(
            $warehouseId,
            $request->input('product_id'),
            $request->input('stock')
        );

        return response()->json(['message' => 'Product attached successfully']);
    }

    public function detach(int $warehouseId, int $productId)
    {
        $this->warehouseService->detachProduct($warehouseId, $productId);
        return response()->json(['message' => 'Product detached successfully']);
    }

    public function update(WarehouseProductUpdateRequest $request, int $warehouseId, int $productId)
    {
        $warehouseProduct = $this->warehouseService->updateProductStock(
            $warehouseId,
            $productId,
            $request->validated()['stock']
        );

        return response()->json([
            'message' => 'Stock updated successfully',
            'data' => $warehouseProduct,
        ]);
    }
}
