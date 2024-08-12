<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'cnpj' => 'required|integer',
            'tipo_usuario' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo NOME é obrigatório!',
            'email.required' => 'O campo EMAIL é obrigatório!',
            'email.unique' => 'EMAIL já associado a outro funcionário!',
            'email.email' => 'EMAIL não é valido!',
            'cnpj.required' => 'O campo CNPJ|CPF é obrigatório!',
            'cnpj.integer' => 'o campo CPNJ deve conter apenas números!',
            'tipo_usuario' => 'O campo TIPO DO USUÁRIO é obrigatório!'
        ];
    }
}
