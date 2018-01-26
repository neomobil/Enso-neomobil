<?php

namespace LaravelEnso\PermissionManager\app\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class VerifyRouteAccess
{
    public function handle($request, Closure $next)
    {
        if (!$request->user()->can('access-route', $request->route()->getName())) {
            \Log::warning(
                'The user having id [ '.$request->user()->id.' ] is not allowed on route [ '.$request->route()->getName().' ] '
                );

            throw new AuthorizationException(__(config('enso.labels.notAuthorized')));
        }

        return $next($request);
    }
}
