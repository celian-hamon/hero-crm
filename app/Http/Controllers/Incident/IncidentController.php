<?php

namespace App\Http\Controllers\Incident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Incident\IncidentService;
use Symfony\Contracts\Service\Attribute\Required;

class IncidentController extends Controller
{
    #[Required]
    private readonly IncidentService $incidentService;

    public function CreateAccident(Request $request)
    {
        return $this->incidentService->CreateAccident($request);
    }

    public function UpdateAccident(Request $request)
    {
        return $this->incidentService->UpdateAccident($request);
    }
}
