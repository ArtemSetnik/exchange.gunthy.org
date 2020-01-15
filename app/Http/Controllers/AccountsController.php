<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AccountsController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
    }

    public function index() {
        return redirect('/home');
    }

    public function wallets(Request $reqeust) {
        return view('pages.balance');
    }

    public function fundsShow(Request $request) {
        return view('pages.funds');
    }

    public function transactions(Request $request) {
        return view('pages.transactions');
    }

    public function home(Request $request) {
        return view('pages.home');
    }

}
