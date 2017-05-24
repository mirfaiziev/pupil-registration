<?php

namespace App\Http\Controllers;

use App\Services\RegistrationService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function search(Request $request)
    {
        $schools = app(RegistrationService::class)->searchCities($request->input('q'));

        return response()->json($schools);
    }

}