<?php

namespace App\Http\Controllers\Hero;

use App\Http\Controllers\Controller;
use HeroService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class GetHeroInRangeController extends Controller
{
    #[Required]
    private readonly HeroService $heroService;

    public function GetHeroInRange(Request $request): JsonResponse|array
    {
        return $this->heroService->GetHeroInRange($request);
    }
}
