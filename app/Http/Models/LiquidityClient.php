<?php

namespace App\Http\Models;

use Ixudra\Curl\Facades\Curl;

use DB;

class LiquidityClient
{
    private static $token = "RQeHRcL25zQzZDM094bU";
    private static $user = 8;
    private static $provider_url = "http://104.248.198.184/liquidity/idax/";

    public static function createBuyOrder($user_id, $data)
    {
        return self::post_api('createBuyOrder', $data);
    }

    public static function createTVBuyOrder($user_id, $data)
    { }

    public static function createSellOrder($user_id, $data)
    { }

    public static function createTVSellOrder($user_id, $data)
    { }







    public static function get_api($url, $data)
    {
        $request_url = self::get_provider_url() . $url . "/" . self::get_token();
        $response = Curl::to($request_url)
            ->withContentType('application/json')
            ->withData($data)
            ->asJson(true)
            ->get();
        return $response;
    }

    public static function post_api($url, $data)
    {
        $data['token'] = self::get_token();
        $user = \Auth::user();
        if(!empty($user)) {
            $data['user_id'] = $user->id;
        }
        
        $request_url = self::get_provider_url() . $url;
        $response = Curl::to($request_url)
            ->withContentType('application/json')
            ->withData($data)
            ->asJson(true)
            ->post();
        return $response;
    }

    public static function send_api($url, $data = [], $type = 'GET')
    {
        if ($type == 'GET') {
            return self::get_api($url, $data);
        }
        return self::post_api($url, $data);
    }

    private static function get_token()
    {
        return self::$token;
    }
    private static function get_provider_url()
    {
        return self::$provider_url;
    }
}
