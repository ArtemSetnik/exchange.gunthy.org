<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class TradesController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function historyShow(Request $request)
    {
        return view('pages.trades');
    }
}
