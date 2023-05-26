<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Accident;
use App\Models\Incident;
use App\Models\Status;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function get(Request $request): Response
    {
        return Inertia::render('Dashboard', [
            'incidents' => Accident::where('user_id', $request->user()->id)
                ->where('status_id', '!=', Status::where('name', 'done')->first()->id)
                ->with('city')
                ->with('incident')
                ->with('status')
                ->get()->toArray(),
            'statuses' => Status::all()->toArray(),
        ]);
    }
}
