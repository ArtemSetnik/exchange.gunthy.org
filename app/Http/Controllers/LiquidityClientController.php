<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

use Yajra\Datatables\Facades\Datatables;

use DB;
use Auth;

use App\Http\Models\LiquidityClient;


class LiquidityClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
    }

    public function placeOrder(Request $request)
    {
        return response()->json("", 201);
    }

    public function openBuyOrders(Request $request)
    {
        return $this->datatables($request, 'openOrders', ['order_side' => 'buy']);
    }

    public function openSellOrders(Request $request)
    {
        return $this->datatables($request, 'openOrders', ['order_side' => 'sell']);
    }

    public function openOrders(Request $request)
    {
        return $this->datatables($request, 'openOrders');
    }


    public function buyOrders(Request $request)
    {
        return $this->datatables($request, 'orderBook', ['order_side' => 'bid']);
    }

    public function sellOrders(Request $request)
    {
        return $this->datatables($request, 'orderBook', ['order_side' => 'ask']);
    }

    public function ordersHistory(Request $request)
    {
        $params = [];
        if ($request->get('order_side')) $params['order_side'] = $request->get('order_side');
        return $this->datatables($request, 'orderHistory', $params);
    }

    public function trades(Request $request)
    {
        return $this->datatables($request, 'trades');
    }

    public function myTrades(Request $request)
    {
        return $this->datatables($request, 'myTrades');
    }
    public function ticker(Request $request)
    {
        return $this->datatables($request, 'ticker');
    }

    public function siteWallets(Request $request)
    {
        return response()->json(LiquidityClient::post_api("balance", []), 200);
    }
    
    public function get24hrVolumns(Request $request)
    {
        return response()->json(LiquidityClient::get_api("24hrVolumns", []), 200);
    }

    private function datatables($request, $url, $data = [])
    {
        $params = $request->getQueryString();
        $table = LiquidityClient::post_api("$url?" . $params, $data);
        return $table;
    }

    public function scheduleStart(Request $request)
    {
        $user = \Auth::user();

        if ($user->isAdmin()) {
            LiquidityClient::get_api('schedule/start', []);
            return "success";
        } else {
            return "error";
        }
    }
    public function scheduleStop(Request $request)
    {
        $user = \Auth::user();

        if ($user->isAdmin()) {
            LiquidityClient::get_api('schedule/stop', []);
            return "success";
        } else {
            return "error";
        }
    }
}
