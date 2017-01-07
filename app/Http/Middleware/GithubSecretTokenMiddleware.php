<?php

namespace App\Http\Middleware;

use Closure;

class GithubSecretTokenMiddleware
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
        $sig_check = 'sha1=' . hash_hmac('sha1', $request->getContent(), config('github.secret_key'));
        if ($sig_check !== $request->header('x-hub-signature'))
            return response(['error' => 'Unauthorized'], 401);

        return $next($request);
    }    
}