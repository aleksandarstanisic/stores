<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;

class RedirectIfBuyerLoged
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
        // if (BAuth::check($request->store)) {
        if (bauth($request->store)->check()) {
            return redirect()->route('shopping.index', [$request->user->slug, $request->store->slug]);
        }
        return $next($request);
    }
}
