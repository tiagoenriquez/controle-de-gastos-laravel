<?php

namespace App\Services;

use App\Models\Item;
use Exception;

class ItemService
{
    public function inserir($nome, $generoId) {
        try {
            $item = new Item();
            $item->nome = $this->validarNome($nome);
            $item->genero_id = $generoId;
            $item->save();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function listar() {
        return Item::with('genero')->orderBy('nome')->get();
    }

    public function procurar($id) {
        try {
            return Item::with('genero')->findOrFail($id);
        } catch (Exception $exception) {
            throw new Exception("Erro ao procurar o item");
        }
    }

    public function alterar($id, $nome, $generoId) {
        try {
            $item = Item::findOrFail($id);
            $item->nome = $this->validarNomeComId($id, $nome);
            $item->genero_id = $generoId;
            $item->save();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function remover($id) {
        try {
            $item = Item::findOrFail($id);
            $item->delete();
        } catch (Exception $exception) {
            throw new Exception("Erro ao remover o item");
        }
    }

    private function validarNome($nome) {
        if (Item::where('nome', $nome)->first()) {
            throw new Exception("Já existe item com o nome informado.");
        }
        return $nome;
    }

    private function validarNomeComId($id, $nome) {
        $item = Item::where('nome', $nome)->first();
        if ($item->id !== $id) {
            throw new Exception("Existe outro item com o mesmo nome.");
        }
        return $nome;
    }
}