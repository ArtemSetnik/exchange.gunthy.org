<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

use App\Http\Models\LiquidityClient;

use DB;

class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
    }

    public function historyShow(Request $reqeust)
    {
        return view('pages.orders');
    }

    public function exchangeShow(Request $request)
    {
        $pair = $request->get('pair');
        if (empty($pair)) $pair = "GUNTHY-BTC";
        $currencies = explode('-', $pair);

        $data['currency_1'] = $currencies[0];
        $data['currency_2'] = $currencies[1];
        $data['fee'] = $this->loadFee();

        return view('pages.exchange', $data);
    }

    public function ticker(Request $request)
    {
        // $response = LiquidityClient::getTicker();
        $currency_2 = $request->currency_2;
        $currency_1 = $request->currency_1;
        $where = compact('currency_2');
        if (!empty($currency_1)) $where['currency_1'] = $currency_1;

        $table = DB::table('gunthy_ticker')->where($where)->get();
        return response()->json($table, 201);
        // return DataTables::of($table)
        //     ->make(true);
    }

    private function loadFee()
    {
        return 0.05;
    }
}
