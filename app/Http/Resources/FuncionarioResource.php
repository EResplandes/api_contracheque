<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FuncionarioResource extends JsonResource
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
            'admissao'      => $this->admissao,
            "status"        => $this->status,
            "empresa"       => $this->empresa,
        ];
    }
}
