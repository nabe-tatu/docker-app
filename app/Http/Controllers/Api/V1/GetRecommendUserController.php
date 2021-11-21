<?php

namespace App\Http\Controllers\Api\V1;

use App\Ddd\User\Application\UseCase\GetRecommendUserUseCase;
use App\Ddd\User\Application\ValueObject\UserStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetRecommendUserController extends Controller
{
    /**
     * @var GetRecommendUserUseCase
     */
    protected $getRecommendUserUseCase;

    /**
     * @param GetRecommendUserUseCase $getRecommendUserUseCase
     */
    public function __construct(GetRecommendUserUseCase $getRecommendUserUseCase)
    {
        $this->getRecommendUserUseCase = $getRecommendUserUseCase;
    }

    /**
     * presentation
     * おすすめユーザーを取得
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        return $this->getRecommendUserUseCase->execute(
            UserStatus::set((int)$request->input('status'))
        );
    }
}
