<?php

namespace App\Http\Validators\Category;

use Illuminate\Support\Facades\Validator;
use Exception;

trait CategoryValidator
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Lütfen kategori başlığı giriniz',
            'title.*' => 'Lütfen geçerli bir kategori başlığı giriniz',
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
