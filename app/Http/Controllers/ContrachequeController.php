<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContrachequeRequest;
use App\Services\ContrachequeService;

class ContrachequeController extends Controller
{
    protected $contrachequeService;

    public function __construct(ContrachequeService $contrachequeService)
    {
        $this->contrachequeService = $contrachequeService; // Metódo responsável por listar contracheques por funcionário
    }

    public function listarContrachequePorFuncionario($id)
    {
        $query = $this->contrachequeService->listar($id);
        return response()->json(['resposta' => $query['resposta'], 'contracheques' => $query['contracheques']], $query['status']);
    }

    public function cadastrarContracheque(ContrachequeRequest $request)
    {
        $query = $this->contrachequeService->cadastrar($request); // Metódo responsável por cadastrar contracheque
        return response()->json(['resposta' => $query['resposta']], $query['status']);
    }
}
