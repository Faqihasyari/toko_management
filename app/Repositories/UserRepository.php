<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll(array $field)
    {
        return User::select($field)->latest()->paginate(50);
    }

    public function getById(int $id, array $fields)
    {
        return User::select($fields)->findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $category = User::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $category = User::findOrFail($id);
        $category->delete();
    }
}
