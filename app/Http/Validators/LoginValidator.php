<?php

namespace App\Http\Validators;

use Exception;
use Illuminate\Support\Facades\Validator;

trait LoginValidator
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'password.required' => 'Password is required',
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
