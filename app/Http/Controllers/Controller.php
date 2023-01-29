<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sucesso(Request $request, string $mensagem) {
        return view('bemVindo', [
            'token' => $request->session()->all()['_token'],
            'usuario' => $request->session()->all()['usuario'],
            'sucesso' => $mensagem
        ]);
    }

    public function erro(Request $request, string $mensagem) {
        return view('bemVindo', [
            'token' => $request->session()->all()['_token'],
            'usuario' => $request->session()->all()['usuario'],
            'erro' => $mensagem
        ]);
    }
}
