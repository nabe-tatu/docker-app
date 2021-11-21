<?php

namespace App\Ddd\User\Application\ValueObject;

class UserStatus
{
    private $status;

    /**
     * @param int $status
     * @return UserStatus
     */
    public static function set(int $status): UserStatus
    {
        $myself = new self();
        $myself->status = $status;
        return $myself;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}
