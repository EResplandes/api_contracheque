<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FuncionarioService;
use App\Http\Requests\FuncionarioRequest;

class FuncionarioController extends Controller
{
    protected $funcionarioService;

    public function __construct(FuncionarioService $funcionarioService)
    {
        $this->funcionarioService = $funcionarioService;
    }

    public function listarFuncionarios()
    {
        $query = $this->funcionarioService->listar(); // Metódo responsável por listar todos funcionários
        return response()->json(['resposta' => $query['resposta'], $query['funcionarios']], $query['status']);
    }

    public function cadastrarFuncionario(FuncionarioRequest $request)
    {
        $query = $this->funcionarioService->cadastrar($request); // Metódo responsável por cadastrar funcionario
        return response()->json(['resposta' => $query['resposta']], $query['status']);
    }
}
