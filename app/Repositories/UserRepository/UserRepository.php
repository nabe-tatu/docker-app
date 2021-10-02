<?php
namespace App\Repositories\UserRepository;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, Array $data)
    {
        $user->update($data);

        return $user;
    }
}
