<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IfKycNotApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->details->kyc_status!=\KYC::STATUS_APPROVED) {

            return redirect()->route('under.review')->with('message','Your account is under review, you will get an email when your account will approved by admin!');
        }
        return $next($request);
    }
}
