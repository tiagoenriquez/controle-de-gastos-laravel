<?php

namespace App\Http\Controllers;

use App\Services\GeneroService;
use Exception;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    private GeneroService $generoService;

    public function __construct()
    {
        $this->generoService = new GeneroService();
    }

    public function create(Request $request) {
        try {
            return view('genero.cadastro', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario']
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function store(Request $request) {
        try {
            $this->generoService->inserir($request->nome);
            return $this->sucesso($request, "Gênero cadastrado com sucesso");
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function index(Request $request) {
        try {
            $generos = $this->generoService->listar();
            return view('genero.todos', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario'],
                'generos' => $generos
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function edit(int $id, Request $request) {
        try {
            $genero = $this->generoService->procurar($id);
            return view('genero.edicao', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario'],
                'genero' => $genero
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function update(int $id, Request $request) {
        try {
            $this->generoService->alterar($id, $request->nome);
            return $this->sucesso($request, "Gênero atualizado com sucesso");
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function decideWhetherToDestroy(int $id, Request $request) {
        try {
            $genero = $this->generoService->procurar($id);
            return view('genero.remocao', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario'],
                'genero' => $genero
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function destroy(int $id, Request $request) {
        try {
            $this->generoService->remover($id);
            return $this->sucesso($request, "Gênero removido com sucesso");
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }
}
