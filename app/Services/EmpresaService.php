<?php

namespace App\Services;

use App\Models\Empresa;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmpresaService
{

    public function listar()
    {
        // 1º Passo -> Buscar todas empresas e retornar resposta
        $query = Empresa::all();

        // 2º Passo -> Retornar resposta
        if ($query) {
            return [
                'resposta' => 'Sucesso',
                'empresas' => $query,
                'status' => Response::HTTP_OK
            ];
        } else {
            return [
                'resposta' => 'Erro',
                'empresas' => null,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }

    public function cadastrar($request)
    {
        // 1º Passo -> Montar array a ser inserido
        $dados = [
            'nome' => $request->input('nome'),
            'cnpj' => $request->input('cnpj')
        ];

        // 2º Passo -> Inserir dados da tabela empresas
        $query = Empresa::create($dados);

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
