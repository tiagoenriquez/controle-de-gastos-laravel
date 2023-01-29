<?php

namespace App\Http\Controllers;

use App\Services\GeneroService;
use App\Services\ItemService;
use Exception;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private GeneroService $generoService;
    private ItemService $itemService;

    public function __construct()
    {
        $this->generoService = new GeneroService();
        $this->itemService = new ItemService();
    }

    public function create(Request $request) {
        $generos = $this->generoService->listar();
        return view('item.cadastro', [
            'token' => $request->session()->all()['_token'],
            'usuario' => $request->session()->all()['usuario'],
            'generos' => $generos
        ]);
    }

    public function store(Request $request) {
        try {
            $this->itemService->inserir($request->nome, $request->genero_id);
            return $this->sucesso($request, "Item cadastrado com sucesso");
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function index(Request $request) {
        try {
            $itens = $this->itemService->listar();
            return view('item.todos', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario'],
                'itens' => $itens
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function edit(int $id, Request $request) {
        try {
            $item = $this->itemService->procurar($id);
            $generos = $this->generoService->listar();
            return view('item.edicao', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario'],
                'item' => $item,
                'generos' => $generos
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function update(int $id, Request $request) {
        try {
            $this->itemService->alterar(
                $id,
                $request->nome,
                $request->genero_id
            );
            return $this->sucesso($request, "Item atualizado com sucesso");
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function decideWhetherToDestroy(int $id, Request $request) {
        try {
            $item = $this->itemService->procurar($id);
            return view('item.remocao', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario'],
                'item' => $item
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function destroy(int $id, Request $request) {
        try {
            $this->itemService->remover($id);
            return $this->sucesso($request, "Item removido com sucesso");
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }
}
