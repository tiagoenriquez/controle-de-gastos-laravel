<?php

namespace App\Services;

use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function checarCredenciais($apelido, $senha) {
        $usuario = $this->procurarPorApelido($apelido);
        $this->checarSenha($senha, $usuario->senha);
        return $usuario;
    }

    private function procurarPorApelido($apelido) {
        $usuario = Usuario::where('apelido', $apelido)->first();
        if (!$usuario) {
            throw new Exception("Credenciais inválidas");
        }
        return $usuario;
    }

    private function checarSenha($senhaInf, $senhaUs) {
        if (!Hash::check($senhaInf, $senhaUs)) {
            throw new Exception("Credenciais inválidas");
        }
    }
}