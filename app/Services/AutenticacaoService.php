<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Queries\AutenticacaoQueries;

class AutenticacaoService
{

    protected $autenticacaoQueries;

    public function __construct(AutenticacaoQueries $autenticacaoQueries)
    {
        $this->autenticacaoQueries = $autenticacaoQueries;
    }

    public function login($request)
    {
        // 1º Passo -> Pegando credenciais
        $credentials = $request->all(['email', 'password']);

        $token = JWTAuth::attempt($credentials);

        // 2º Passo -> Autenticando e gerando token
        if ($token) {

            $resultado = $this->autenticacaoQueries->buscaInformacoes($credentials['email']); // Query responsável por buscar dados do usuário

            // Retornando resposta
            return ['resposta' => 'Autenticação realizada com sucesso!', 'usuario' => $resultado, 'token' => $token, 'status' => Response::HTTP_OK];
        }

        // Retornando caso usuário não seja encontrado
        return ['resposta' => 'Usuário ou senha inválidos!', 'usuario' => null, 'token' => null, 'status' => Response::HTTP_FORBIDDEN];
    }

    public function logout($request)
    {
        // 1º Passo -> Armazenando token
        $token = $request->input('token');

        // 2º Passo -> Coloca toke na blakclist
        $query = auth('api')->logout($token); // Colocando token na blacklist

        // 3º Passo -> Retorna respsota
        return ['resposta' => 'Logout realizado com sucesso!', 'status' => Response::HTTP_OK];
    }

    public function verificaToken()
    {
        return ['resposta' => 'O Token está válido!', 'status' => Response::HTTP_OK];
    }

    public function alterarSenha($request, $id)
    {
        // 1º Passo -> Altera senha do usuário e status de primeiro acesso 0
        $nova_senha = $request->input('nova_senha');

        $dados = [
            'password' => bcrypt($nova_senha),
            'primeiro_acesso' => 0
        ];

        User::where('id', $id)
            ->update($dados);

        // 2º Passo -> Retorna resposta
        return ['resposta' => 'Senha alterada com sucesso!', 'status' => Response::HTTP_OK];
    }
}
