<?php

namespace App\Http\Middleware;

use App\Services\UsuarioService;
use Closure;
use Exception;
use Illuminate\Http\Request;

class Administrador
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
            $usuarioService = new UsuarioService();
            if (!$usuarioService->checarAdministrador(
                $request->session()->all()['usuario']->id
            )) {
                throw new Exception(
                    "Usuário sem permissão para o recurso acionado"
                );
            }
            return $next($request);
        } catch(Exception $exception) {
            return redirect('/')->with(['erro' => $exception->getMessage()]);
        }
    }
}
