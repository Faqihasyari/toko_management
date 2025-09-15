<?php

namespace App\Services;

use App\Repositories\UserRoleRepository;

class UserRoleService
{
    private UserRoleRepository $userRoleRepository;

    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }
}