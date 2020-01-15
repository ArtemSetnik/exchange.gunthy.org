<?php

namespace App\Http\Controllers;

use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        if ($user && $user->isAdmin()) {
            // return view('pages.admin.home');;
        }
        if($user && $user->enabledGoogle2fa() && !$user->validatedGoogle2fa()) {
            return redirect()->guest('google2fa/validate');
        }
        return view('pages.home');
    }

    public function profile()
    {
        return view('pages.profile');
    }
}
