<?php

namespace LMS\Billings\Http\Requests\Billings;

use Illuminate\Foundation\Http\FormRequest;

class CreateBillingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_token' => 'required',
            'plan_id' => 'required',
            'last_digits' => 'required|min:4|max:4',
            'brand' => 'required|string'
        ];
    }
}
