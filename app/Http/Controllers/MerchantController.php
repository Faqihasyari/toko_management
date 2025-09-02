<?php

namespace App\Http\Controllers;

use App\Http\Resources\MerchantResource;
use App\Services\MerchantService;
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

    
}
