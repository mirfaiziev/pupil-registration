<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use App\Services\PupilService;
use App\Services\RegistrationService;
use Illuminate\Http\Request;

class PupilController extends Controller
{
    /**
     * @var PupilService
     */
    protected $pupilService;

    /**
     * PupilController constructor.
     */
    public function __construct()
    {
        $this->pupilService = app(PupilService::class);
    }

    public function index()
    {

    }

    public function confirm()
    {

    }

    public function showRegistrationFrom()
    {
        return view(
            'pupil.register',
            [
                'events' => app(EventService::class)->loadCurrents()
            ]
        );
    }

    public function register(Request $request)
    {
        $validator = $this->getValidationFactory()->make(
            $request->all(),
            [
                'first_name'  => 'required',
                'family_name' => 'required',
                'city'        => 'required',
                'school'      => 'required',
                'class'       => 'required',
                'teacher'     => 'required',
                'email'       => 'required|email',
                'phone'       => 'required',
                'event'       => 'required',
            ]
        );

        if ($validator->fails()) {
            return view(
                'pupil.register',
                [
                    'form'   => $request->all(),
                    'events' => app(EventService::class)->loadCurrents()
                ]
            )->withErrors($validator);
        }

        app(RegistrationService::class)->register(
            array_merge($request->all(), ['ip' => $request->ip()])
        );

        return redirect(
        )->route('home')->with('message', 'ok');
    }

    public function suggestName(Request $request)
    {
        return response()->json($this->pupilService->searchNames($request->input('q')));
    }
}