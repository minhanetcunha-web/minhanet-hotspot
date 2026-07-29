<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'tempo' => ['required', 'integer', 'min:1'],
            'unidade_tempo' => ['required', 'string', 'max:50'],
            'preco' => ['required', 'numeric', 'min:0'],
            'download' => ['required', 'integer', 'min:1'],
            'upload' => ['required', 'integer', 'min:1'],
            'simultaneos' => ['required', 'integer', 'min:1'],
        ];
    }
}
