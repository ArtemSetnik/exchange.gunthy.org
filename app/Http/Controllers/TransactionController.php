<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function history(Request $request) {
        $user = Auth::user();
        
    }
}
