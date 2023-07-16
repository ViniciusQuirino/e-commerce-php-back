<?php
namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' =>  ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => "Email é obrigatório",
            'email.email' => 'Email deve ser um endereço válido',
            'password.required' => "Senha é obrigatório",
        ];
    }
}
