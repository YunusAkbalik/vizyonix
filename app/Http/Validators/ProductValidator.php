<?php

namespace App\Http\Validators;

use Exception;
use Illuminate\Support\Facades\Validator;

trait ProductValidator
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|numeric',
            'price' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Lütfen ürün başlığı giriniz',
            'title.*' => 'Lütfen geçerli bir ürün başlığı giriniz',
            'category_id.*' => 'Lütfen geçerli bir kategori seçiniz',
            'price.*' => 'Lütfen geçerli bir fiyat giriniz',
        ];
    }

    public function validations(): void
    {
        $validator = Validator::make(request()->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }
    }


}
