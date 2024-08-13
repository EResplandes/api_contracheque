<?php

namespace App\Services;

use App\Models\Contracheque;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NovoContrachequeDisponivel;

class ContrachequeService
{
    public function listar($idFuncionario)
    {

        // 1º Passo -> Buscar todos contracheques de um funcionario de acordo com id passado pela rota
        $query = Contracheque::where('funcionario_id', $idFuncionario)
            ->get();

        // 2º Passo -> Retornar resposta
        if ($query) {

            return [
                'resposta' => 'Sucesso',
                'contracheques' => $query,
                'status' => Response::HTTP_OK
            ];
        } else {

            return [
                'resposta' => 'Erro',
                'contracheques' => null,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }

    public function cadastrar($request)
    {

        DB::beginTransaction();

        try {

            // 1º Passo -> Salvar arquivo no diretório public
            $directory = "/contracheques"; // Criando diretório

            $pdf = $request->file('anexo')->store($directory, 'public'); // Salvando pdf do contracheque

            // 2º Passo -> inserir dados na tabela contracheques
            Contracheque::create([
                'anexo' => $pdf,
                'funcionario_id' => $request->input('funcionario_id'),
                'mes_referencia' => $request->input('mes_referencia'),
                'ano_referencia' => $request->input('ano_referencia')
            ]);

            // 3º Passo -> Pegando dados do funcionário
            $user = User::find($request->input('funcionario_id'));

            // 4º Passo -> Disparar e-mail informando aviso de novo contracheque disponível
            Mail::to($user->email)->queue(new NovoContrachequeDisponivel($user));

            // 5º Passo -> Retornar resposta

            DB::commit();

            return [
                'resposta' => 'Sucesso',
                'status' => Response::HTTP_CREATED
            ];
        } catch (\Exception $e) {

            DB::rollBack();

            return [
                'resposta' => 'Erro',
                'erro' => $e,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
