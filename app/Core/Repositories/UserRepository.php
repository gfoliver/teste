<?php

namespace App\Core\Repositories;

use App\Core\Repositories\Contracts\IUserRepository;
use App\Models\User;

class UserRepository implements IUserRepository
{
    public function create(array $data): ?User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): ?User
    {
        if (($user = $this->byId($id)) && $user->update($data))
            return $user;

        return null;
    }

    public function delete(int $id): bool
    {
        if (($user = $this->byId($id)) && $user->delete())
            return true;

        return false;
    }

    public function byId(int $id, array $with = []): ?User
    {
        $query = User::where('id', $id);

        if (!empty($with))
            $query->with($with);

        return $query->first();
    }
}
