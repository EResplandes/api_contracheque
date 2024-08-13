<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContrachequeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'anexo' => 'required|file|mimes:pdf',
            'funcionario_id' => 'required|integer',
            'mes_referencia' => 'required|integer',
            'ano_referencia' => 'required|integer|digits:4|min:1900'
        ];
    }

    public function messages()
    {
        return [
            'anexo.required' => 'O campo ANEXO é obrigatório!',
            'anexo.file' => 'O campo ANEXO deve ser um arquivo!',
            'anexo.mimes' => 'O ANEXO deve ser um PDF!',
            'funcionario_id.required' => 'A seleção do funcionário é obrigatória!',
            'funcionario_id.integer' => 'O funcionário deve ser um inteiro',
            'mes_referencia.required' => 'O campo MÊS DE REFERÊNCIA é obrigatório!',
            'mes_referencia.integer' => 'O campo MÊS DE REFERÊNCIA deve ser um número de 1 a 12',
            'ano_referencia.integer' => 'O campo ANO deve ser um número inteiro.',
            'ano_referencia.digits' => 'O campo ANO deve ter exatamente 4 dígitos.',
            'ano_referencia.min' => 'O ANO deve ser maior ou igual a 1900.',
            'ano_referencia.required' => 'O campo ANO DE REFERÊNCIA é obrigatório!'
        ];
    }
}
