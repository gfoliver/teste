<?php

namespace App\Core\Services\Contracts;

use App\Models\User;

interface IUserService
{
    public function create(array $data): ?User;

    public function update(int $id, array $data): ?User;

    public function delete(int $id): bool;

    public function byId(int $id, array $with = []): ?User;
}
