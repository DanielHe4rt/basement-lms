<?php

namespace LMS\Billings\Http\Requests\Cards;

use Illuminate\Foundation\Http\FormRequest;

class CreateCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'card' => 'required',
            'last_digits' => 'required|min:4|max:4',
            'brand' => 'required|string'
        ];
    }
}
