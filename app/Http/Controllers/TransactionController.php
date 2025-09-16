<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController
{
    //

    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $fields = ['*'];
        $transactions = $this->transactionService->getAll($fields);
        return response()->json(TransactionResource::collection($transactions));
    }

    public function store(TransactionRequest $request)
    {
        $transactions = $this->transactionService->createTransaction($request->validated());

        return response()->json([
            'massage' => 'Transaction recorded successfully',
            'data' => $transactions,
        ], 201);
    }
}
