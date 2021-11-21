<?php

namespace App\Ddd\User\Infrastructure\Repository;

use App\Ddd\User\Application\ValueObject\UserStatus;
use App\Ddd\User\Domain\Entity\GetRecommendUserEntity;
use App\Ddd\User\Domain\RepositoryInterface\GetRecommendUserRepositoryInterface;
use App\Models\User;

class GetRecommendUserRepository implements GetRecommendUserRepositoryInterface
{
    /**
     * Infrastructure
     * TODO::おすすめユーザー取得ロジックを作成します
     * おすすめユーザーを取得
     * DBから取得してEntityにつめて返却
     * @param UserStatus $userStatus
     * @return GetRecommendUserEntity
     */
    public function getRecommendUser(UserStatus $userStatus): GetRecommendUserEntity
    {
        $users = User::paginate($userStatus->getStatus());

        return GetRecommendUserEntity::entity($users);
    }
}
