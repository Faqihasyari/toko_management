<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseProductRequest;
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
}
