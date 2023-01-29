<?php

namespace App\Services;

use App\Models\Lancamento;
use App\Models\LancamentoPorGenero;
use Exception;
use Illuminate\Support\Facades\DB;

class LancamentoService
{
    private GeneroService $generoService;

    public function __construct()
    {
        $this->generoService = new GeneroService();
    }

    public function inserir($data, $valor, $tipo, $itemId, $usuarioId) {
        try {
            $lancamento = new Lancamento();
            $lancamento->data = $data;
            $lancamento->valor = $this->editarValor($valor, $tipo);
            $lancamento->item_id = $itemId;
            $lancamento->usuario_id = $usuarioId;
            $lancamento->save();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function listarTodosDoTipoNoMes($tipo, $data, $usuarioId) {
        try {
            $sinal = $tipo === 'gasto' ? '<' : '>';
            $mes = substr($data, 0, 7);
            $lancamentos = Lancamento::where('valor', $sinal, '0')
                ->where('data', 'like', $mes . '%')
                ->where('usuario_id', $usuarioId)
                ->orderByDesc('data')
                ->get();
            return $lancamentos;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function procurar($id, $usuarioId) {
        try {
            $lancamento = Lancamento::with('item')->findOrFail($id);
            return $this->validarDono($lancamento, $usuarioId);
        } catch (Exception $exception) {
            throw new Exception("Lançamento não encontrado");
        }
    }


    public function alterar($id, $data, $valor, $tipo, $itemId, $usuarioId) {
        try {
            $lancamento = $this->procurar($id, $usuarioId);
            $lancamento->data = $data;
            $lancamento->valor = $this->editarValor($valor, $tipo);
            $lancamento->item_id = $itemId;
            $lancamento->usuario_id = $usuarioId;
            $lancamento->save();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function remover($id, $usuarioId) {
        try {
            $lancamento = $this->procurar($id, $usuarioId);
            $lancamento->delete();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function removerTodos($usuarioId) {
        $lancamentos = Lancamento::where('usuario_id', $usuarioId)->get();
        if (count($lancamentos) > 0) {
            foreach ($lancamentos as $lancamento) {
                $lancamento->delete();
            }
        }
    }

    public function dados($data, $usuarioId) {
        $gastos = $this->somar('gasto', $data, $usuarioId);
        $proventosAnterior = $this->somar(
            'provento',
            date('Y-m-d', strtotime('-1 month', strtotime($data))),
            $usuarioId
        );
        $dados = [];
        array_push($dados, ['Gastos', $gastos]);
        array_push($dados, [
            'Proventos no mês anterior',
            $proventosAnterior
        ]);
        array_push($dados, [
            'Quanto posso gastar por dia no mês',
            $this->qpgpdnm(
                $gastos,
                $proventosAnterior,
                $data
            )
        ]);
        return $dados;
    }

    public function lancamentosPorGenero($data, $usuarioId) {
        $generos = $this->generoService->listar();
        $generosComLancamentos = [];
        foreach ($generos as $genero) {
            $lancamentoPorGenero = new LancamentoPorGenero(
                $genero->nome,
                $this->somarLancamentosDeGenero($genero, $data, $usuarioId)
            );
            array_push($generosComLancamentos, $lancamentoPorGenero);
        }
        usort($generosComLancamentos, function($primeiro, $segundo) {
            return $segundo->soma < $primeiro->soma;
        });
        return $generosComLancamentos;
    }

    private function somarLancamentosDeGenero($genero, $data, $usuarioId) {
        $mes = substr($data, 0, 7);
        $lancamentos = DB::table('lancamentos')
            ->join('items', 'lancamentos.item_id', '=', 'items.id')
            ->join('generos', 'items.genero_id', '=', 'generos.id')
            ->select('lancamentos.*', 'generos.nome')
            ->where('data', 'like', $mes . '%')
            ->where('usuario_id', $usuarioId)
            ->where('generos.nome', $genero->nome)
            ->get();
        $soma = 0.0;
        foreach ($lancamentos as $lancamento) {
            $soma += $lancamento->valor;
        }
        return $soma;
    }

    private function editarValor($valor, $tipo) {
        try {
            $valor = floatval(str_replace(",", ".", $valor));
            if ($tipo === 'gasto') {
                $valor = 0 - $valor;
            }
            return $valor;
        } catch (Exception $exception) {
            throw new Exception("Valor inválido");
        }
    }

    private function validarDono($lancamento, $usuarioId) {
        if ($lancamento->usuario_id !== $usuarioId) {
            throw new Exception("Lançamento não pertence ao usuário.");
        }
        return $lancamento;
    }

    private function somar($tipo, $data, $usuarioId) {
        $lancamentos = $this->listarTodosDoTipoNoMes($tipo, $data, $usuarioId);
        $soma = 0.0;
        foreach ($lancamentos as $lancamento) {
            $soma += abs($lancamento->valor);
        }
        return $soma;
    }

    private function qpgpdnm($gastos, $proventosAnterior, $data) {
        $diferenca = $proventosAnterior - $gastos;
        $qpgpdnm = 0.0; // Quanto posso gastar por dia no mês
        $dia = date('d', strtotime($data));
        $ultimoDiaDoMes = date('t', strtotime($data));
        $drnm = floatval($ultimoDiaDoMes) - floatval($dia); //Dias restantes no mês
        if ($diferenca > 0) {
            if ($dia === $ultimoDiaDoMes) {
                $qpgpdnm = $diferenca;
            } else {
                $qpgpdnm = $diferenca / $drnm;
            }
        }
        return $qpgpdnm;
    }
}