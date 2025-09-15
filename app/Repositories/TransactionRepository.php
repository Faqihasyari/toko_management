<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepositor
{
    public function getAll(array $fields)
    {
        return Transaction::select($fields)
            ->with(['transactionProducts.product', 'merchant.keeper']) // eager loading
            ->latest()
            ->paginate(50);
    }

    public function getById(int $id, array $fields)
    {
        return Transaction::select($fields)
            ->with(['transactionProducts.product', 'merchant.keeper'])
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return Transaction::create($data);
    }
}
