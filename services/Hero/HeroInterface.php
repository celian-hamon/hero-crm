<?php

use App\Models\Incident;
use Illuminate\Http\Request;

interface HeroInterface
{

    public function GetHeroInRange(Request $request);
    public function  IsHeroInRange(mixed $lat, mixed $lng, mixed $hero, Incident $incident);
}
