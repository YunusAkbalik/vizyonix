<?php

namespace App\Http\Validators;

use Exception;
use Illuminate\Support\Facades\Validator;

trait RegisterValidator
{
    public function rules_register(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'password' => 'required',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'accept_terms' => 'required',
        ];
    }

    public function messages_register(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'name.required' => 'Name is required',
            'name.string' => 'Name is invalid',
            'password.required' => 'Password is required',
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'Phone is invalid',
            'accept_terms.required' => 'If you want to register you need to accept the terms and conditions',
        ];
    }

    public function validations_register(): void
    {
        $validator = Validator::make(request()->all(), $this->rules_register(), $this->messages_register());
        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }
    }


}
