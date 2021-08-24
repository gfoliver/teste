<?php

namespace App\Core\Services;

use App\Core\Repositories\Contracts\IUserRepository;
use App\Core\Services\Contracts\IUserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    /* @var IUserRepository */
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $data): ?User
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->create($data);
    }

    public function update(int $id, array $data): ?User
    {
        foreach($data as $key => $field)
            if (empty($field))
                unset($data[$key]);

        return $this->userRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->userRepository->delete($id);
    }

    public function byId(int $id): ?User
    {
        return $this->userRepository->byId($id);
    }

    public function byEmail(string $email): ?User
    {
        return $this->userRepository->byEmail($email);
    }

}
