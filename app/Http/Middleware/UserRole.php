<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserRole
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
        if (auth()->user()->role === 'viewer' || auth()->user()->role === 'product') {
            $notification = [
                'message' => __('Unauthorized Access'),
                'alert-type' => 'success'
            ];
            return redirect()->route('manage-product')->with($notification);
        }
        return $next($request);
    }
}
