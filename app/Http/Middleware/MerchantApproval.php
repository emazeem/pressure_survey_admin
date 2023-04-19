<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MerchantApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->roles->slug=='merchant'){
            if (auth()->user()->details->account_status != \MERCHANT_ACC_STATUS::STATUS_APPROVED) {
                return \redirect()->route('merchant.status');
            }
        }

        return $next($request);
    }
}
