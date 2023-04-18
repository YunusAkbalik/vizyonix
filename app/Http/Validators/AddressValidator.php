<?php

namespace App\Http\Validators;

use Exception;
use Illuminate\Support\Facades\Validator;

trait AddressValidator
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|numeric',
            'country' => 'required|numeric',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
        ];
    }

    public function messages(): array
    {
        return [
            'name.*' => 'Please enter a valid name',
            'username.*' => 'Please enter a valid username',
            'address.*' => 'Please enter a valid address',
            'city.*' => 'Please enter a valid city',
            'zip.*' => 'Please enter a valid zip',
            'country.*' => 'Please choose a valid country',
            'email.*' => 'Please choose a valid email',
            'phone.*' => 'Please enter a valid phone',
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
