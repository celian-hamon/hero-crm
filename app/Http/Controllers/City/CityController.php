<?php
namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use City\CityService;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class CityController extends Controller{

    #[Required]
    private readonly CityService $cityService;

    public function CreateCity(Request $request) {
        return $this->cityService->CreateCity($request);
    }
}
