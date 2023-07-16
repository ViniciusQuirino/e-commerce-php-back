<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
            'age' => ['required', 'regex:/^[0-9]+$/', function ($attribute, $value, $fail) {
                $minAge = 18;
                $age = (int) $value;
                if ($age < $minAge) {
                    $fail("A $attribute deve ser maior ou igual a $minAge anos.");
                }
            }],
            'cpf' => ['required', 'min:11', 'max:11'],
            'type' => ['nullable',Rule::in(['cliente', 'vendedor'])],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'email.required' => 'Email é obrigatório',
            'email.email' => 'Email deve ser um endereço válido',
            'cpf.required' => 'CPF é obrigatório',
            'cpf.min' => 'CPF deve conter no mínimo 11 caracteres',
            'cpf.max' => 'CPF deve conter no máximo 11 caracteres',
            'password.required' => 'Senha é obrigatório',
            'password.regex' => 'Senha deve conter 8 caracteres, 1 letra maiúscula e 1 letra minuscula no mínimo.',
            'age.required' => 'Idade é obrigatório.',
            'age.regex' => 'Idade é obrigatório que seja um numero.',
            'type.in' => 'O campo type deve ser "cliente" ou "vendedor"',
        ];
    }
}
