<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProtectedApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkSignature');
    }
    public function balancesAndInfo(Request $request)
    {
        return response()->json($request->user, 200);
    }

    public function openOrders(Request $request)
    {

    }

    public function userTransactions(Request $request)
    {

    }

    public function cryptoDepositAddressGet(Request $request)
    {

    }

    public function cryptoDepositAddressNew(Request $request)
    {

    }

    public function depositGet(Request $request)
    {

    }

    public function withdrawalsGet(Request $request)
    {

    }

    public function ordersNew(Request $request)
    {

    }

    public function ordersEdit(Request $request)
    {

    }

    public function ordersCancel(Request $request)
    {

    }

    public function ordersStatus(Request $request)
    {

    }

    public function withdrawalsNew(Request $request)
    {

    }

}
