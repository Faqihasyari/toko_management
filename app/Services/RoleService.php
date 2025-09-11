<?php

namespace App\Repositories;

class RoleService
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAll(array $fields)
    {
        return $this->roleRepository->getAll($fields);
    }

    public function getById(int $id, array $fields)
    {
        return $this->roleRepository->getById($id, $fields ?? ['*']);
    }
}
