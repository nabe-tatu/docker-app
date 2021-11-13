<?php
namespace App\Repositories\UserRepository;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function store(Array $data);

    /**
     * @param User $user
     * @param array $data
     * @return mixed
     */
    public function update(User $user, Array $data);
}
