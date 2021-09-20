<?php


namespace LMS\Lessons\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateLessonRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $e = explode('/', $this->url());
        $maxIndex = count($e);
        $this->merge([
            'course_id' => $e[$maxIndex - 4],
            'module_id' => $e[$maxIndex - 2]
        ]);
    }

    public function rules()
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'module_id' => 'required|exists:course_modules,id',
            'type_id' => 'required|exists:course_levels,id',
            'title' => 'required|string|max:60',
            'description' => 'required|string',
        ];
    }

}
