<?php

namespace LMS\Billings\Http\Requests\Plans;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:billing_plans',
            'interval' => 'required|unique:billing_plans',
            'price' => 'required|'
        ];
    }
}
