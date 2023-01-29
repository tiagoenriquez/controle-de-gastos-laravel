<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use App\Services\LancamentoService;
use Exception;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    private ItemService $itemService;
    private LancamentoService $lancamentoService;

    public function __construct()
    {
        $this->itemService = new ItemService();
        $this->lancamentoService = new LancamentoService();
    }

    public function create(Request $request) {
        $itens = $this->itemService->listar();
        return view('lancamento.cadastro', [
            'token' => $request->session()->all()['_token'],
            'usuario' => $request->session()->all()['usuario'],
            'itens' => $itens
        ]);
    }

    public function store(Request $request) {
        try {
            $this->lancamentoService->inserir(
                $request->data,
                $request->valor,
                $request->tipo,
                $request->item_id,
                $request->session()->all()['usuario']->id
            );
            return $this->sucesso(
                $request,
                "Lançamento cadastrado com sucesso"
            );
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function gastosDoMesAtual(Request $request) {
        try {
            $tipo = 'gasto';
            $data = date('Y-m-d');
            $lancamentos = $this->lancamentoService->listarTodosDoTipoNoMes(
                $tipo,
                $data,
                $request->session()->all()['usuario']->id
            );
            return view('lancamento.todosDoTipoNoMes', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario'],
                'tipo' => $tipo,
                'data' => $data,
                'lancamentos' => $lancamentos
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function todosDoTipoNoMes(Request $request) {
        try {
            $tipo = $request->tipo;
            $data = $request->data;
            $lancamentos = $this->lancamentoService->listarTodosDoTipoNoMes(
                $tipo,
                $data,
                $request->session()->all()['usuario']->id
            );
            return view('lancamento.todosDoTipoNoMes', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario'],
                'tipo' => $tipo,
                'data' => $data,
                'lancamentos' => $lancamentos
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function edit(int $id, Request $request) {
        try {
            $usuario = $request->session()->all()['usuario'];
            $lancamento = $this->lancamentoService->procurar(
                $id,
                $usuario->id
            );
            $itens = $this->itemService->listar();
            $tipo = $lancamento->valor < 0 ? 'gasto' : 'provento';
            return view('lancamento.edicao', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $usuario,
                'lancamento' => $lancamento,
                'itens' => $itens,
                'tipo' => $tipo
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function update(int $id, Request $request) {
        try {
            $this->lancamentoService->alterar(
                $id,
                $request->data,
                $request->valor,
                $request->tipo,
                $request->item_id,
                $request->session()->all()['usuario']->id
            );
            return $this->sucesso($request, "Lançamento alterado com sucesso");
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function decideWhetherToDestroy(int $id, Request $request) {
        try {
            $usuario = $request->session()->all()['usuario'];
            $lancamento = $this->lancamentoService->procurar(
                $id,
                $usuario->id
            );
            return view('lancamento.remocao', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $usuario,
                'lancamento' => $lancamento
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function destroy(int $id, Request $request) {
        try {
            $this->lancamentoService->remover(
                $id,
                $request->session()->all()['usuario']->id
            );
            return $this->sucesso($request, "Lançamento removido com sucesso");
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function dadosDoMesAtual(Request $request) {
        try {
            $dados = $this->lancamentoService->dados(
                date('Y-m-d'),
                $request->session()->all()['usuario']->id
            );
            return view('lancamento.dados', [
                'dados' => $dados,
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario']
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function dados(Request $request) {
        try {
            $dados = $this->lancamentoService->dados(
                $request->data,
                $request->session()->all()['usuario']->id
            );
            return view('lancamento.dados', [
                'dados' => $dados,
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario']
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function lancamentosPorGeneroNoMesAtual(Request $request) {
        try {
            $data = date('Y-m-d');
            $generos = $this->lancamentoService->lancamentosPorGenero(
                $data,
                $request->session()->all()['usuario']->id
            );
            return view('lancamento.porGenero', [
                'generos' => $generos,
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario']
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function lancamentosPorGenero(Request $request) {
        try {
            $data = $request->data;
            $generos = $this->lancamentoService->lancamentosPorGenero(
                $data,
                $request->session()->all()['usuario']->id
            );
            return view('lancamento.porGenero', [
                'generos' => $generos,
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario']
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function decideWhetherToDestroyAll(Request $request) {
        try {
            return view('lancamento.removerTodos', [
                'token' => $request->session()->all()['_token'],
                'usuario' => $request->session()->all()['usuario']
            ]);
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }

    public function destroyAll(Request $request) {
        try {
            $usuario = $request->session()->all()['usuario'];
            $this->lancamentoService->removerTodos($usuario->id);
            return $this->sucesso(
                $request,
                "Lançamentos removidos com sucesso"
            );
        } catch (Exception $exception) {
            return $this->erro($request, $exception->getMessage());
        }
    }
}
