<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Repositories\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $fields = ['id', 'name'];
        $roles = $this->roleService->getAll($fields ?: ['*']);
        return response()->json(RoleResource::collection($roles));
    }

    public function show(int $id)
    {
        $fields = ['id', 'name'];
        $role = $this->roleService->getById($id, $fields ?: ['*']);
        return response()->json(new RoleResource($role));
    }
}
