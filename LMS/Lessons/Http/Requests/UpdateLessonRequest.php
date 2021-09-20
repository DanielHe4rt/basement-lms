<?php


namespace LMS\Lessons\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
            'course_id' => $e[$maxIndex - 5],
            'module_id' => $e[$maxIndex - 3],
            'lesson_id' => $e[$maxIndex - 1],
        ]);
    }

    public function rules()
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'module_id' => 'required|exists:course_modules,id',
            'lesson_id' => 'required|exists:course_module_lessons,id',
            'title' => 'string|max:60',
            'description' => 'string',
            'content' => 'nullable'
        ];
    }

}
