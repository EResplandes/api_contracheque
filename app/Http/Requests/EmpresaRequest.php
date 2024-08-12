<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|unique:empresas',
            'cnpj' => 'required|digits:14|unique:empresas'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo NOME é obrigatório!',
            'nome.unique' => 'A EMPRESA já está cadastrada!',
            'cnpj.required' => 'O campo CNPJ é obrigatório!',
            'cnpj.digits' => 'CNPJ inválido, quantidade de caracteres errados!',
            'cnpj.unique' => 'A EMPRESA já está cadastrada!'
        ];
    }
}
