<?php

namespace App\Services;

use App\Models\RememberToken;
use Exception;
use Illuminate\Support\Facades\Hash;

class RememberTokenService
{
    public function inserir($token, $usuarioId) {
        $rememberToken = new RememberToken();
        $rememberToken->token = Hash::make($token);
        $rememberToken->usuario_id = $usuarioId;
        $rememberToken->save();
    }

    public function procurarToken($token, $usuarioId) {
        try {
            $rememberToken = RememberToken::where(
                'usuario_id', $usuarioId
            )->firstOrFail();
            if (!Hash::check($token, $rememberToken->token)) {
                throw new Exception("Falha na autenticação");
            }
        } catch (Exception $exception) {
            throw new Exception("Falha na autenticação");
        }
    }

    public function removerToken($usuarioId) {
        try {
            $tokens = RememberToken::where('usuario_id', $usuarioId)->get();
            foreach ($tokens as $token) {
                $token->delete();
            }
        } catch (Exception $exception) {
            throw new Exception ("Erro na remoção dos tokens");
        }
    }
}