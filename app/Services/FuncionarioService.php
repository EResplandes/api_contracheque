<?php

namespace App\Services;

use App\Http\Resources\FuncionarioResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function cadastrar($request)
    {
        // 1º Passo -> Montar array a ser inserido
        $dados = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'cnpj' => $request->input('cnpj'),
            'tipo_usuario' => 'Funcionario',
            'status' => 'Ativo',
            'admissao' => $request->input('admissao'),
            'empresa_id' => $request->input('empresa'),
            'password' => bcrypt($request->input('senha'))
        ];

        // 2º Passo -> Inserir dados da tabela users
        $query = User::create($dados);

        // 3º Passo -> Retornar resposta
        if ($query) {
            return [
                'resposta' => 'Sucesso',
                'status' => Response::HTTP_CREATED
            ];
        } else {
            return [
                'resposta' => 'Erro',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
