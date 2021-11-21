<?php

namespace App\Ddd\User\Domain\Entity;

use Illuminate\Pagination\LengthAwarePaginator;

class GetRecommendUserEntity
{
    private $users;

    private function __construct() {}

    /**
     * @param LengthAwarePaginator $users
     * @return GetRecommendUserEntity
     */
    public static function entity(LengthAwarePaginator $users): GetRecommendUserEntity
    {
        $myself = new self();
        $myself->users = $users;
        return $myself;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }
}
