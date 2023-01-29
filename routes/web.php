<?php

use App\Http\Controllers\GeneroController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'create'])->name('form-login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::prefix('usuario')->group(function() {
    Route::get('/', [UsuarioController::class, 'create'])->name('form-cadastro-usuario');
    Route::post('/', [UsuarioController::class, 'store'])->name('cadastro-usuario');
});

Route::middleware('token')->group(function() {
    Route::prefix('/usuario')->group(function() {
        Route::get('/{id}', [UsuarioController::class, 'edit'])->name('form-edicao-usuario');
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('edicao-usuario');
    });
    Route::middleware('administrador')->group(function() {
        Route::prefix('genero')->group(function() {
            Route::get('/cadastro', [GeneroController::class, 'create'])->name('form-cadastro-genero');
            Route::post('/', [GeneroController::class, 'store'])->name('cadastro-genero');
            Route::get('/', [GeneroController::class, 'index'])->name('lista-generos');
            Route::get('/{id}', [GeneroController::class, 'edit'])-> name('form-edicao-genero');
            Route::put('/{id}', [GeneroController::class, 'update'])->name('edicao-genero');
            Route::get('/remocao/{id}', [GeneroController::class, 'decideWhetherToDestroy'])->name('form-remocao-genero');
            Route::delete('/{id}', [GeneroController::class, 'destroy'])->name('remocao-genero');
        });
        Route::prefix('item')->group(function() {
            Route::get('/cadastro', [ItemController::class, 'create'])->name('form-cadastro-item');
            Route::post('/', [ItemController::class, 'store'])->name('cadastro-item');
            Route::get('/', [ItemController::class, 'index'])->name('lista-itens');
            Route::get('/{id}', [ItemController::class, 'edit'])->name('form-edicao-item');
            Route::put('/{id}', [ItemController::class, 'update'])->name('edicao-item');
            Route::get('/remocao/{id}', [ItemController::class, 'decideWhetherToDestroy'])->name('form-remocao-item');
            Route::delete('/{id}', [ItemController::class, 'destroy'])->name('remocao-item');
        });
    });
    Route::prefix('lancamento')->group(function() {
        Route::get('/cadastro', [LancamentoController::class, 'create'])->name('form-cadastro-lancamento');
        Route::get('/dados-do-mes-atual', [LancamentoController::class, 'dadosDoMesAtual'])->name('dados-do-mes-atual');
        Route::get('/dados', [LancamentoController::class, 'dados'])->name('dados');
        Route::get('/por-genero-no-mes-atual', [LancamentoController::class, 'lancamentosPorGeneroNoMesAtual'])->name('lancamentos-por-genero-no-mes-atual');
        Route::get('/por-genero', [LancamentoController::class, 'lancamentosPorGenero'])->name('lancamentos-por-genero');
        Route::get('/remover-todos', [LancamentoController::class, 'decideWhetherToDestroyAll'])->name('form-remocao-todos-lancamentos');
        Route::post('/', [LancamentoController::class, 'store'])->name('cadastro-lancamento');
        Route::get('/gastos-do-mes-atual', [LancamentoController::class, 'gastosDoMesAtual'])->name('gastos-do-mes-atual');
        Route::get('/', [LancamentoController::class, 'todosDoTipoNoMes'])->name('lancamento');
        Route::get('/{id}', [LancamentoController::class, 'edit'])->name('form-edicao-lancamento');
        Route::put('/{id}', [LancamentoController::class, 'update'])->name('edicao-lancamento');
        Route::get('/remocao/{id}', [LancamentoController::class, 'decideWhetherToDestroy'])->name('form-remocao-lancamento');
        Route::delete('/{id}', [LancamentoController::class, 'destroy'])->name('remocao-lancamento');
        Route::delete('/', [LancamentoController::class, 'destroyAll'])->name('remocao-todos-lancamentos');
    });
    Route::get('logout/{id}', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/{slug?}', function() {
    return view('naoEncontrada');
});
