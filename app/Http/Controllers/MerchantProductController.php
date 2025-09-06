<?php

namespace App\Http\Controllers;

use App\Http\Requests\MerchantProductRequest;
use App\Services\MerchantProductService;
use Illuminate\Http\Request;

class MerchantProductController
{
    //

    private MerchantProductService $merchantProductService;

    public function __construct(MerchantProductService $merchantProductService)
    {
        $this->merchantProductService = $merchantProductService;
    }

    public function store(MerchantProductRequest $request, int $merchant)
    {
        $validated = $request->validated();
        $validated['merchant_id'] = $merchant;

        $merchantProduct = $this->merchantProductService->assignProductToMerchant($validated);

        return response()->json([
            'message' => 'Product assigned to merchant successfully',
            'data' => $merchantProduct,
        ], 201);
    }
}
