<?php


namespace LMS\Modules\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateModuleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
        ];
    }

}
