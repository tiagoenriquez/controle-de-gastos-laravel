<?php

namespace App\Http\Middleware;

use App\Models\RememberToken;
use App\Services\RememberTokenService;
use Closure;
use Exception;
use Illuminate\Http\Request;

class TokenCheck
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
        try {
            $rememberTokenService = new RememberTokenService();
            $rememberTokenService->procurarToken(
                $request->session()->all()['_token'],
                $request->session()->all()['usuario']->id
            );
            return $next($request);
        } catch (Exception $exception) {
            return redirect('/')->with(['erro' => $exception->getMessage()]);
        }
    }
}
