<?php

namespace App\Services;

use App\Http\Resources\FuncionarioResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FuncionarioService
{

    public function listar()
    {
        // 1º Passo -> Buscar na tabela users todos os usuários do tipo Funcionario
        $query = FuncionarioResource::collection(User::where('tipo_usuario', 'Funcionario')->get());

        // 2º Passo -> Retornando resposta
        if ($query) {
            return [
                'resposta' => 'Sucesso',
                'funcionarios' => $query,
                'status' => Response::HTTP_OK
            ];
        } else {
            return [
                'resposta' => 'Erro',
                'funcionarios' => null,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }

    public function cadastrar
}
