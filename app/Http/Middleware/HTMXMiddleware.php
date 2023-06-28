<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class HTMXMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        View::share('isHTMXRequest', $request->headers->has('hx-request'));
        View::share('isHTMXBoosted', $request->headers->has('hx-boosted'));
        $request->attributes->set('htmx', $request->headers->has('hx-request'));
        $request->attributes->set('htmx-boosted', $request->headers->has('hx-boosted'));
        $request->attributes->set('htmx-trigger', !$request->headers->has('hx-boosted')  && $request->headers->has('hx-request'));
        return $next($request);
    }
}
