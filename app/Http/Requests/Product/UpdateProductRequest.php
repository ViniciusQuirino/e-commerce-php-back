<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:100'],
            'description' =>  ['nullable', 'max:255', 'min:80'],
            'voltage' => ['nullable', 'min:4', 'max:4', 'in:127v,220v,110v'],
            'brand' => ['nullable', 'max:20'],
            'price' => ['nullable', 'numeric'],
            'image' => ['nullable', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'O campo name deve ter menos de ou igual a 100 caracteres.',
            'description.max' => 'O campo description deve ter menos de ou igual a 255 caracteres.',
            'description.min' => 'O campo description deve ter no mínimo 80 caracteres',
            'voltage.min' => 'O campo voltage deve ter no minimo 4 caracteres.',
            'voltage.in' => 'O campo voltage deve ser uma das seguintes: 127v, 220v, 110v',
            'voltage.max' => 'O campo voltage deve ter no máximo 4 caracteres.',
            'brand.max' => 'O campo brand deve ter menos de ou igual a 20 caracteres.',
            'price.numeric' => 'O campo price deve ser um número.',
            'image.max' => 'O campo image deve ter menos de ou igual a 255 caracteres.',
        ];
    }
}
