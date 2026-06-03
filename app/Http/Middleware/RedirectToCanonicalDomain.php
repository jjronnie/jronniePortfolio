<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToCanonicalDomain
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! app()->isProduction()) {
            return $next($request);
        }

        $canonical = config('app.canonical_domain', 'jronnie.techtowerinc.com');

        if ($request->getHost() !== $canonical) {
            $url = $request->getScheme().'://'.$canonical.$request->getRequestUri();

            return redirect($url, 301);
        }

        return $next($request);
    }
}
