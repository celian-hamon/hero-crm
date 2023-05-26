<?php

namespace App\Http\Controllers\Hero;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Incident;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class GetHeroInRangeController extends Controller
{
    public function GetHeroInRange(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'inc' => 'required',
        ]);

        if (isset($data['city'])) {
            $position = City::where('id', $data['city'])->first();
        } else if (isset($data['lat']) && isset($data['lng'])) {
            $position = [
                $data['lat'],
                $data['lng'],
            ];
        } else {
            return response()->json([
                'message' => 'Please provide a city or a position',
            ], 400);
        }

        $inc = $data['inc'];
        $incident = Incident::where('name', $inc)->first();

        $heroes = User::all();
        $availableHeroes = [];
        for ($i = 0; $i < count($heroes); $i++) {
            $hero = $heroes[$i];
            if ($this->isHeroInRange($position[0], $position[1], $hero, $incident)) {
                $availableHeroes[] = $hero;
            }
        }
        return $availableHeroes;
    }

    private function isHeroInRange(mixed $lat, mixed $lng, mixed $hero, Incident $incident)
    {
        if (!in_array($incident->id, $hero->incidents->pluck('id')->toArray())) {
            return false;
        }
        //if in 50km range return true
        $positions = explode(',', $hero->location);
        $lat = $positions[0];
        $lng = $positions[1];

        $earthRadius = 6371;
        $dLat = deg2rad($lat - $lat);
        $dLng = deg2rad($lng - $lng);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat)) * cos(deg2rad($lat)) * sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        if ($distance <= 50) {
            return true;
        }
        return false;
    }
}
