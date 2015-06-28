<?php namespace App\Http\Middleware;

use Closure;

class VerifyApprovedUsers {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
       // dd($request);

        //if the user is logged in
        if($request->user()!=null)
        {
            //then verify that they are approved
            //if not approved erase use from request and treat as non logged in user

            if(!$request->user()->approved)
            {

                return redirect('auth/logout');
            }


        }
		return $next($request);
	}

}
