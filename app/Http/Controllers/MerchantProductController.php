<?php

namespace App\Http\Controllers;

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
}
