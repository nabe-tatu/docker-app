<?php
namespace App\Repositories\UserRepository;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param String $email
     * @return mixed
     */
    public function firstByEmail(String $email)
    {
        return User::where('email', $email)->first();
    }
    /**
     * @param array $data
     * @return mixed
     */
    public function store(Array $data)
    {
        return User::create($data);
    }

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
