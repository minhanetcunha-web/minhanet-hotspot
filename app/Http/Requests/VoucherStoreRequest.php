<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'perfil' => ['required', 'string', 'max:255'],
            'valor' => ['required', 'numeric', 'min:0.01'],
        ];
    }
}
