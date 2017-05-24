<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('index');
        } else {
            return redirect()->route('pupil-register-form');
        }
    }

    public function pageNotFound()
    {
        return view('404');
    }

}
