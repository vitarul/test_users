<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkDeleteUserRequest;
use App\Http\Requests\BulkUpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(User $user): JsonResponse
    {
        return (new UserResource($user))->response();
    }

    public function index(): AnonymousResourceCollection
    {
        $users = $this->userRepository->getAllUsers();

        return UserResource::collection($users);
    }

    public function update(User $user, UserRequest $request): JsonResponse
    {
        $user->update($request->getData());

        return (new UserResource($user))->response();
    }

    public function bulkUpdate(BulkUpdateUserRequest $request): AnonymousResourceCollection
    {
        $users = $this->userRepository->bulkUpdate($request->getIds(), $request->getData());

        return UserResource::collection($users);
    }

    public function delete(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['message' => 'ok']);
    }

    public function bulkDelete(BulkDeleteUserRequest $request): JsonResponse
    {
        $this->userRepository->bulkDelete($request->getIds());

        return response()->json(['message' => 'ok']);
    }
}
