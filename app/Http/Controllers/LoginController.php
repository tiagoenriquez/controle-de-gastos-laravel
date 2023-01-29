<?php

namespace App\Http\Controllers;

use App\Models\RememberToken;
use App\Services\LoginService;
use App\Services\RememberTokenService;
use Exception;
use Illuminate\Http\Request;

class LoginController
{
    private LoginService $loginService;
    private RememberTokenService $rememberTokenService;

    public function __construct()
    {
        $this->loginService = new LoginService();
        $this->rememberTokenService = new RememberTokenService();
    }

    public function create() {
        return view('login');
    }

    public function login(Request $request) {
        try {
            $usuario = $this->loginService->checarCredenciais(
                $request->apelido,
                $request->senha
            );
            $request->session()->put('usuario', $usuario);
            $token = $request->session()->all()['_token'];
            $this->rememberTokenService->removerToken($usuario->id);
            $this->rememberTokenService->inserir($token, $usuario->id);
            return view('bemVindo', [
                'token' => $token,
                'usuario' => $usuario
            ]);
        } catch (Exception $exception) {
            return view('login', ['erro' =>$exception->getMessage()]);
        }
    }

    public function logout(int $id, Request $request) {
        try {
            $request->session()->flush();
            $this->rememberTokenService->removerToken($id);
            return redirect('/');
        } catch (Exception $exception) {
            return redirect('/')->with(['erro' => $exception->getMessage()]);
        }
    }
}