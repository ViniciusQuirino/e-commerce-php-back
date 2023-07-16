<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable'],
            'email' => ['nullable', 'email'],
            'password' => ['nullable', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
            'age' => ['nullable', 'numeric', function ($attribute, $value, $fail) {
                $minAge = 18;
                $age = (int)$value;
                if ($age < $minAge) {
                    $fail("A $attribute deve ser maior ou igual a $minAge anos.");
                }
            }],
            'cpf' => ['nullable', 'min:11', 'max:11'],
            'type' => ['nullable', Rule::in(['cliente', 'vendedor'])],
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Email deve ser um endereço válido',
            'password.regex' => 'Senha deve conter 8 caracteres, 1 letra maiúscula e 1 letra minuscula no mínimo.',
            'cpf.min' => 'CPF deve conter no mínimo 11 caracteres',
            'cpf.max' => 'CPF deve conter no máximo 11 caracteres',
            'age.numeric' => 'Obrigatório que idade seja um numero e maior ou igual que 18.',
            'type.in' => 'O campo type deve ser "cliente" ou "vendedor"',
        ];
    }
}
