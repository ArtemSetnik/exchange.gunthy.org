<?php
namespace App\Http\Models;

use Ixudra\Curl\Facades\Curl;
use App\Models\Apikeys;

class GunthyApi
{

	protected static $errors = [];

	public static function getValidApi($params, $signature)
	{
        $api_key = $params['api_key'];
        $api = Apikeys::where('key', $api_key)->first();
        if (empty($api)) {
			self::addError('Invalid Api_key', "INVALID_APIKEY");
			return false;
		}

		$nonce = $params['nonce'];
		if(!self::validNonce($nonce, $api->nonce)) {
			return false;
		}

		$api->nonce = $nonce;
		$api->save();

        $api_secret = $api->secret;
        if (!self::validSignature($params, $api_secret, $signature)) {
            return false;
		}

		return $api;
	}

	public static function order($params)
	{

	}

	public static function getErrors()
	{
		$errors = self::$errors;
		self::$errors = [];

		return $errors;
	}


	public static function addError($message, $code)
	{
		self::$errors[] = compact('message', 'code');
	}

	protected static function makeSignature($params, $secret)
	{
		$signature = hash_hmac('sha256', base64_encode(json_encode($params, JSON_NUMERIC_CHECK)), $secret);
		return $signature;
	}

	protected static function validSignature($params, $secret, $signature)
	{
		$confirm = self::makeSignature($params, $secret);
		if($confirm != $signature) {
			self::addError('Invalid Signature', 'AUTH_INVALID_SIGNATURE');
			return false;
		}
		return true;
	}

	protected static function validNonce($nonce, $before_nonce)
	{
		$nonce = intval($nonce);
		$before_nonce = intval($before_nonce);
		if($nonce <= $before_nonce) {
			self::addError('Invalid Nonce', 'INVALID_NONCE');
			return false;
		}
		return true;
	}

}
