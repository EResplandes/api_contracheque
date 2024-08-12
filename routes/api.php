<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\EmpresaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Módulo de Autenticação
Route::prefix("/autenticacao")->group(function () {
    Route::controller(AutenticacaoController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/logout', 'logout');
        Route::get('/token', 'verificaToken')->middleware('jwt.auth');
    });
});

// Módulo de Empresas
Route::prefix('empresas')->group(function () {
    Route::controller(EmpresaController::class)->group(function () {
        Route::get('/listar', 'listarEmpresas');
        Route::post('/cadastrar', 'cadastrarEmpresa');
    });
});
