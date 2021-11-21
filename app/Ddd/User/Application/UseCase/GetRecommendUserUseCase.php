<?php

namespace App\Ddd\User\Application\UseCase;

use App\Ddd\User\Application\ValueObject\UserStatus;
use App\Ddd\User\Infrastructure\Repository\GetRecommendUserRepository;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetRecommendUserUseCase
{
    /**
     * @var GetRecommendUserRepository
     */
    protected $getRecommendUserRepository;

    /**
     * @param GetRecommendUserRepository $getRecommendUserRepository
     */
    public function __construct(GetRecommendUserRepository $getRecommendUserRepository)
    {
        $this->getRecommendUserRepository = $getRecommendUserRepository;
    }

    /**
     * Application
     * おすすめユーザーを取得
     * getRecommendUserRepositoryでユーザー取得して、entityにデータ渡して、entityを受け取る
     * AnonymousResourceCollectionで返却
     * @param UserStatus $userStatus
     * @return AnonymousResourceCollection
     */
    public function execute(UserStatus $userStatus): AnonymousResourceCollection
    {
        $entity = $this->getRecommendUserRepository->getRecommendUser($userStatus);

        return UserResource::collection($entity->getUsers());
    }
}
