<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class KYC
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $basic = (object) config('basic');

        $validator = Validator::make($request->all(),[]);

        if($basic->identity_verification == 1 && Auth::user()->identity_verify != '2'){
            $validator->errors()->add('identity', '1');
            return redirect()->route('user.profile')->withErrors($validator)->withInput();
        }

        if($basic->address_verification == 1 && Auth::user()->address_verify != '2'){
            $validator->errors()->add('addressVerification', '1');
            return redirect()->route('user.profile')->withErrors($validator)->withInput();
        }
        return $next($request);
    }
}
