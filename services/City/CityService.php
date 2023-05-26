<?php

namespace City;

use App\Models\City;
use Illuminate\Http\Request;

class CityService implements \CityInterface
{
    public function CreateCity(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        $data = $request->all();
        $city = City::create([
            "name" => $data['name'],
            "location" => $data['latitude'] . "," . $data['longitude'],
        ]);
        return redirect()->back();
    }
}
