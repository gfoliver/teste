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

    public function byId(int $id): ?User
    {
        return User::find($id);
    }

    public function byEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
