<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Exception;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    private UsuarioService $usuarioService;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
    }

    public function create() {
        return view('usuario.cadastro');
    }

    public function store(Request $request) {
        try {
            $this->usuarioService->inserir(
                $request->nome,
                $request->apelido,
                $request->senha,
                $request->confirmacao
            );
            return view('login', [
                'sucesso' => "Usuário cadastrado com sucesso"
            ]);
        } catch(Exception $exception) {
            return view('login', ['erro' => $exception->getMessage()]);
        }
    }

    public function edit(int $id, Request $request) {
        try {
            $usuario = $this->usuarioService->procurar($id);
            return view('usuario.edicao', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $usuario
            ]);
        } catch (Exception $exception) {
            return view('login', [
                'erro' => $exception->getMessage()
            ]);
        }
    }

    public function update(int $id, Request $request) {
        try {
            $this->usuarioService->alterar(
                $id,
                $request->nome,
                $request->apelido,
                $request->senha,
                $request->confirmacao
            );
            return $this->sucesso(
                $request,
                "Cadastro de usuário atualizado com sucesso"
            );
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }
}
