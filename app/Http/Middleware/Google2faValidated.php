<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Google2faValidated
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
		$user = $request->user();
		if(empty($user)) {
			return rediret()->guest('login');
		}

		if (!$user->enabledGoogle2fa()) {
			$path = $request->path();
			// if(strpos($path, 'apikeys') == 0 || !empty($path))
			if(strpos($path, 'apikeys') !== false)
				return redirect()->guest('google2fa');
			return $next($request);
		}
		if (!$user->validatedGoogle2fa()) {
			return redirect()->guest('google2fa/validate');
		}
		return $next($request);
	}
}
