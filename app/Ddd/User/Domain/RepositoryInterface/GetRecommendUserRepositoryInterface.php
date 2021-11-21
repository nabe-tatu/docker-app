<?php

namespace App\Ddd\User\Domain\RepositoryInterface;

use App\Ddd\User\Application\ValueObject\UserStatus;

interface GetRecommendUserRepositoryInterface
{
    /**
     * @param UserStatus $userStatus
     * @return mixed
     */
    public function getRecommendUser(UserStatus $userStatus);
}
