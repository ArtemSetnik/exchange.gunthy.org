<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Models\GunthyApi;

class CheckSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $commands = $request->except('signature');
        $signature = $request->signature;

        $api = GunthyApi::getValidApi($commands, $signature);
        if(empty($api)) {
            $errors = GunthyApi::getErrors();
            return response()->json($errors, 200);
        }

        $request->merge(['api_id' => $api->id, 'user' => $api->user]);

        return $next($request);
    }
}
