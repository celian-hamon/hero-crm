<?php

namespace App\Http\Controllers\Incident;

use App\Http\Controllers\Controller;
use App\Models\Accident;
use App\Models\City;
use App\Models\Incident;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function CreateAccident(Request $request)
    {

        $request->validate([
            'location' => 'required',
            'hero' => 'required',
            'incident' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        $status = Status::where('name', 'pending')->first();
        $hero = User::where('id', (int)$data['hero'])->first();
        if ($hero == null) {
            return redirect()->back()->withErrors(['hero' => 'Hero not found']);
        }
        $city = City::where('id', $data['city'])->first();
        if ($city == null) {
            return redirect()->back()->withErrors(['city' => 'City not found']);
        }
        $incident = Incident::where('name', $data['incident'])->first();
        if ($incident == null) {
            return redirect()->back()->withErrors(['incident' => 'Incident not found']);
        }

        Accident::create([
            "description" => $data['description'],
            "user_id" => $hero->id,
            "incident_id" => $incident->id,
            "city_id" => $city->id,
            "status_id" => $status->id,
        ]);

        return redirect('/dashboard');
    }

    public function UpdateAccident(Request $request)
    {
        $data = $request->all();
        if (!isset($data['status']) || !isset($data['id'])) {
            return redirect()->back()->withErrors(['status' => 'Status not found']);
        }
        $status = Status::where('id', $data['status'])->first();
        if ($status == null) {
            return redirect()->back()->withErrors(['status' => 'Status not found']);
        }
        $accident = Accident::where('id', $data['id'])->first();
        if ($accident == null) {
            return redirect()->back()->withErrors(['accident' => 'Accident not found']);
        }
        $accident->status_id = $status->id;
        $accident->save();
        return redirect()->back();
    }
}
