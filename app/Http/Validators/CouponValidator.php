<?php

namespace App\Http\Validators;
use Illuminate\Support\Facades\Validator;
use Exception;

trait CouponValidator
{
    public function rules(): array
    {
        return [
            'code' => 'required|string',
            'discount' => 'required|numeric',
            'min_purchase' => 'required|numeric',
            'usage_limit' => 'required|numeric',
            'usage_date_start' => 'required|date',
            'usage_date_end' => 'required|date',
            'status' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Kod gereklidir',
            'discount.required' => 'İndirim gereklidir',
            'min_purchase.required' => 'Minimum alışveriş tutarı gereklidir',
            'usage_limit.required' => 'Kullanım sınırı gereklidir',
            'usage_date_start.required' => 'Kullanım başlangıç tarihi gereklidir',
            'usage_date_end.required' => 'Kullanım bitiş tarihi gereklidir',
            'status.required' => 'Durum gereklidir',
            'code.string' => 'Kod metin olmalıdır',
            'discount.numeric' => 'İndirim sayı olmalıdır',
            'min_purchase.numeric' => 'Minimum alışveriş tutarı sayı olmalıdır',
            'usage_limit.numeric' => 'Kullanım sınırı sayı olmalıdır',
            'usage_date_start.date' => 'Kullanım başlangıç tarihi tarih olmalıdır',
            'usage_date_end.date' => 'Kullanım bitiş tarihi tarih olmalıdır',
            'status.numeric' => 'Durum sayı olmalıdır',
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
