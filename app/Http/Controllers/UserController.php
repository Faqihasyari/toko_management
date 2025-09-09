<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $fields = ['id', 'name', 'email', 'photo', 'phone'];
        $users = $this->userService->getAll($fields ?: ['*']);
        return response()->json(UserResource::collection($users));
    }

    public function show(int $id)
    {
        $fields = ['id', 'name', 'email', 'photo', 'phone'];
        $user = $this->userService->getById($id, $fields ?: ['*']);
        return response()->json(new UserResource($user));
    }
}
