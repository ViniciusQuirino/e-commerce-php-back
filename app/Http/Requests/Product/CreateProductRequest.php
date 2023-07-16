<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'description' =>  ['required', 'max:255', 'min:80'],
            'voltage' => ['required', 'min:4', 'max:4', 'in:127v,220v,110v'],
            'brand' => ['required', 'max:20'],
            'price' => ['required', 'numeric'],
            'image' => ['required', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo name é obrigatório.',
            'name.max' => 'O campo name deve ter menos de ou igual a 100 caracteres.',
            'description.required' => 'O campo description é obrigatório.',
            'description.min' => 'O campo description deve ter no mínimo 80 caracteres',
            'description.max' => 'O campo description deve ter menos de ou igual a 255 caracteres.',
            'voltage.required' => 'O campo voltage é obrigatório.',
            'voltage.min' => 'O campo voltage deve ter no minimo 4 caracteres.',
            'voltage.max' => 'O campo voltage deve ter no máximo 4 caracteres.',
            'voltage.in' => 'O campo voltage deve ser uma das seguintes: 127v, 220v, 110v',
            'brand.required' => 'O campo brand é obrigatório.',
            'brand.max' => 'O campo brand deve ter menos de ou igual a 20 caracteres.',
            'price.required' => 'O campo price é obrigatório.',
            'price.numeric' => 'O campo price deve ser um número.',
            'image.required' => 'O campo image é obrigatório.',
            'image.max' => 'O campo image deve ter menos de ou igual a 255 caracteres.',
        ];
    }
}
