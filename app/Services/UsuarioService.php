<?php

namespace App\Services;

use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\Hash;

class UsuarioService
{
    public function inserir($nome, $apelido, $senha, $confirmacao) {
        $usuario = new Usuario();
        $usuario->nome = $this->checarNome($nome, 0);
        $usuario->apelido = $this->checarApelido($apelido, 0);
        $usuario->administrador = $this->serAdministrador();
        $usuario->senha = $this->checarSenhas($senha, $confirmacao);
        $usuario->save();
    }

    public function procurar($id) {
        try {
            return Usuario::find($id);
        } catch (Exception $exception) {
            throw new Exception("Não há usuário com o id informado");
        }
    }

    public function alterar($id, $nome, $apelido, $senha, $confirmacao) {
        $usuario = $this->procurar($id);
        $usuario->nome = $this->checarNome($nome, $id);
        $usuario->apelido = $this->checarApelido($apelido, $id);
        $usuario->senha = $this->checarSenhas($senha, $confirmacao);
        $usuario->save();
    }

    public function checarAdministrador($id) {
        $usuario = $this->procurar($id);
        if ($usuario->administrador) return true;
        return false;
    }

    private function checarNome($nome, $id) {
        foreach (Usuario::all() as $usuario) {
            if ($usuario->nome === $nome && $usuario->id !== $id) {
                throw new Exception("Já existe usuário com o nome informado.");
            }
        }
        return $nome;
    }

    private function checarApelido($apelido, $id) {
        foreach (Usuario::all() as $usuario) {
            if ($usuario->apelido === $apelido && $usuario->id !== $id) {
                throw new Exception(
                    "Já existe usuário com o apelido informado."
                );
            }
        }
        return $apelido;
    }

    private function serAdministrador() {
        if (Usuario::count() === 0) return true;
        return false;
    }

    private function checarSenhas($senha, $confirmacao) {
        if ($senha !== $confirmacao) {
            throw new Exception("Senhas não conferem.");
        }
        return Hash::make($senha);
    }
}