<?php

namespace App\Core\Repositories\Contracts;

use App\Models\User;

interface IUserRepository
{
    public function create(array $data): ?User;

    public function update(int $id, array $data): ?User;

    public function delete(int $id): bool;

    public function byId(int $id, array $with = []): ?User;
}
