<?php


namespace LMS\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateMeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'document_number' => 'required|string',
            'name' => 'string|min:6|max:80',
            'phone_number' => 'required|string',
            'birthdate' => 'required|date',
            'username' => 'required|string',
            'address.street' => 'required|string|nullable',
            'address.number' => 'required|string|nullable',
            'address.neighborhood' => 'required|string|nullable',
            'address.city' => 'required|string|nullable',
            'address.state' => 'required|string|nullable',
            'address.zip_code' => 'required|string|nullable',
        ];
    }

}
