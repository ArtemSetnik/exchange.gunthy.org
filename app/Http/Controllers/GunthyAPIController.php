<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Apikeys;

class GunthyAPIController extends Controller
{
    public function __construct()
    {
        $this->middleware('2fa');
    }

    // display API page.
    public function show(Request $request)
    {
        $user = $request->user();
        $keys = Apikeys::where('user_id', $user->id)->get();
        $api = $request->session()->pull('api', null);
        return view('pages.apikeys.show', compact('keys','api'));
    }

    public function generate(Request $request)
    {
        $this->validate($request, ['api_name' => 'required'],['api_name.required' => 'Api Name required']);
        $user = Auth::user();
        $api = $this->newAPIKeys($user->id, $request->api_name);
        $request->session()->put('api', $api);
        return redirect('apikeys');
    }

    public function deleteApikey(Request $request)
    {
        $id = $request->api_id;
        Apikeys::findOrFail($id)->delete();
        return redirect('apikeys');
    }

    private function newAPIKeys($user_id, $api_name)
    {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$key = substr(str_shuffle($chars),0,16);
		$secret = substr(str_shuffle($chars),0,32);
        $api = new Apikeys();
        $api->user_id = $user_id;
        $api->api_name = $api_name;
        $api->key = $key;
        $api->secret = $secret;
        $api->save();
        return $api;
    }

}
