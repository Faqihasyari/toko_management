<?php

namespace App\Http\Controllers;

use App\Http\Resources\MerchantResource;
use App\Services\MerchantService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MerchantController
{
    //

    private MerchantService $merchantService;

    public function __construct(MerchantService $merchantService)
    {
        $this->merchantService = $merchantService;
    }

    public function index()
    {
        $fields = ['*'];
        $merchants = $this->merchantService->getAll($fields ?? ['*']);
        return response()->json(MerchantResource::collection($merchants));
    }

    public function show(int $id)
    {
        try {
            $fields = ['id', 'name', 'photo', 'keeper_id'];
            $merchant = $this->merchantService->getById($id, $fields);

            return response()->json(new MerchantResource($merchant));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'merchant not found',
            ], 404);
        }
    }
}
