<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutenticacaoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            "id"            => $this->id,
            "nome"          => $this->name,
            "cnpj"          => $this->cnpj,
            "email"         => $this->email,
            'tipo_usuario'  => $this->tipo_usuario,
            'admissao'      => $this->admissao,
            "status"        => $this->status,
            "empresa"       => $this->empresa,
        ];
    }
}
