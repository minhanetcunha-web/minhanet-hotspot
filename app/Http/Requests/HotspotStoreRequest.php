<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotspotStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'ip' => ['required', 'ip'],
            'porta' => ['required', 'integer', 'min:1', 'max:65535'],
            'usuario' => ['required', 'string', 'max:255'],
            'senha' => ['required', 'string'],
            'nome_hotspot' => ['nullable', 'string', 'max:255'],
            'ativo' => ['nullable', 'boolean'],
        ];
    }
}
