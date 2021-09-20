<?php


namespace LMS\Lessons\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UploadLessonVideoRequest extends FormRequest
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
            'course_id' => $e[$maxIndex - 6],
            'module_id' => $e[$maxIndex - 4],
            'lesson_id' => $e[$maxIndex - 2],
        ]);
    }

    public function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'module_id' => 'required|exists:course_modules,id',
            'lesson_id' => 'required|exists:course_module_lessons,id',
            'video' => 'required|mimes:mp4'
        ];
    }

}
