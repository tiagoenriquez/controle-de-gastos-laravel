<?php

namespace App\Services;

use App\Models\Genero;
use Exception;

class GeneroService
{
    public function inserir($nome) {
        try {
            $genero = new Genero();
            $genero->nome = $this->validarNome($nome);
            $genero->save();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function listar() {
        return Genero::orderBy('nome')->get();
    }

    public function procurar($id): Genero {
        try {
            return Genero::findOrFail($id);
        } catch (Exception $exception) {
            throw new Exception("Erro ao procurar o gênero");
        }
    }

    public function alterar($id, $nome) {
        try {
            $genero = $this->procurar($id);
            $genero->nome = $this->validarNomeDoId($id, $nome);
            $genero->save();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function remover($id) {
        try {
            $genero = $this->procurar($id);
            $genero->delete();
        } catch (Exception $exception) {
            throw new Exception("Erro ao remover o gênero");
        }
    }

    private function validarNome($nome) {
        if (Genero::where('nome', $nome)->first()) {
            throw new Exception("Já existe gênero com nome informado");
        }
        return $nome;
    }

    private function validarNomeDoId($id, $nome) {
        $genero = Genero::where('nome', $nome)->first();
        if ($genero->id !== $id) {
            throw new Exception("Existe outro gênero com o nome informado");
        }
        return $nome;
    }
}