<?php
use Illuminate\Http\Request;
interface IncidentInterface
{
    public function CreateAccident(Request $request);
    public function UpdateAccident(Request $request);
}
