<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AutenticacaoService;
use App\Http\Requests\AutenticacaoRequest;

class AutenticacaoController extends Controller
{
    protected $autenticacaoService;

    public function __construct(AutenticacaoService $autenticacaoService)
    {
        $this->autenticacaoService = $autenticacaoService;
    }

    public function login(AutenticacaoRequest $request)
    {
        $query = $this->autenticacaoService->login($request); // Consulta para realizar autenticação
        return response()->json(['resposta' => $query['resposta'], 'usuario' => $query['usuario'], 'token' => $query['token']], $query['status']); // Retornando resposta
    }

    public function logout(Request $request)
    {
        $query = $this->autenticacaoService->logout($request); // Consulta para realizar invalidação do token
        return response()->json(['resposta' => $query['resposta']], $query['status']); // Retornando resposta
    }

    public function verificaToken()
    {
        $query = $this->autenticacaoService->verificaToken(); // Valida Token
        return response()->json(['resposta' => $query['resposta']], $query['status']); // Retornando resposta
    }

    public function alterarSenha(Request $request, $id)
    {
        $query = $this->autenticacaoService->alterarSenha($request, $id); // Altera a senha do usuário
        return response()->json(['resposta' => $query['resposta']], $query['status']);
    }
}
