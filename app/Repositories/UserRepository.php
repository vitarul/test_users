<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function getByIds(array $ids): Collection
    {
        return User::query()->find($ids);
    }

    public function getAllUsers(): Collection
    {
        return User::query()->get();
    }

    public function bulkUpdate(array $ids, array $data): Collection
    {
        $users = $this->getByIds($ids);

        foreach ($users as $user) {
            $user->update($data);
        }

        return $users;
    }

    public function bulkDelete(array $ids): void
    {
        $users = $this->getByIds($ids);

        foreach ($users as $user) {
            $user->delete();
        }
    }
}
