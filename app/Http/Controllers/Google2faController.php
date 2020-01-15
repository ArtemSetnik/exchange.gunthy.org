<?php

namespace App\Http\Controllers;

use Crypt;
use Google2FA;
use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \ParagonIE\ConstantTime\Base32;

use Auth;

class Google2faController extends Controller
{
    // use ValidatesRequests;

    // private $user;
    protected $redirect_to = "google2fa";

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $types = [
            ['key' => 'google', 'name' => 'Google Authentication'],
        ];
        return view('2fa/index', compact('types'));
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function showEnableTwoFactor(Request $request)
    {
        //generate new secret
        $secret = $this->generateSecret();

        //get user
        $user = $request->user();

        $request->session()->put('google2fa_secret', Crypt::encrypt($secret));

        //generate image for QR barcode
        $imageDataUri = Google2FA::getQRCodeInline(
            $request->getHttpHost(),
            $user->email,
            $secret,
            200
        );

        return view('2fa/enableTwoFactor', ['image' => $imageDataUri,
            'secret' => $secret]);
    }

    public function enableTwoFactor(Request $request)
    {
        $google2fa_secret = $request->session()->pull('google2fa_secret', null);
        $user = $request->user();
        $user->google2fa_secret = $google2fa_secret;
        $user->save();

        return redirect()->intended($this->redirect_to);
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function disableTwoFactor(Request $request)
    {
        $user = $request->user();

        //make secret column blank
        $user->google2fa_secret = null;
        $request->session()->pull('google_2fa_token', null);
        $user->save();

        return redirect('google2fa');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function getValidateToken(Request $request)
    {
        $user = $request->user();
        if(!$user->enabledGoogle2fa()) {
            return redirect()->guest($this->redirect_to);
        }
        $request->session()->put('2fa:user:id', $user->id);
        return view('2fa/validateTwoFactor');
    }

    /**
     *
     * @param  App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postValidateToken(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'google_2fa_token' => [
                'bail',"required","digits:6",
                function ($attribute, $value, $fail) use($user) {
                    $secret = Crypt::decrypt($user->google2fa_secret);
                    if(!Google2FA::verifyKey($secret, $value)) {
                        $fail('Not a valid token');
                    }
                },
                function ($attribute, $value, $fail) use($user) {
                    $key = $user->id . ':' . $value;

                    if(Cache::has($key)) {
                        $fail('Cannot reuse token');
                    }
                }
            ]
        ]);
        //get user id and create cache key
        $key    = $user->id . ':' . $request->google_2fa_token;

        //use cache to store token to blacklist
        Cache::add($key, true, 4);
        $request->session()->put('google_2fa_token', $request->google_2fa_token);

        return redirect()->intended($this->redirect_to);
    }

    /**
     * Generate a secret key in Base32 format
     *
     * @return string
     */
    private function generateSecret()
    {
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes);
    }
}