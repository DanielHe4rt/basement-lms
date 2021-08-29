<?php


namespace LMS\Modules\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateModuleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order' => 'required',
            'name' => 'string',
            'description' => 'string',
        ];
    }

}
