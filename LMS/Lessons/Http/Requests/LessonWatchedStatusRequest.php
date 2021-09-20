<?php


namespace LMS\Lessons\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LessonWatchedStatusRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $e = explode('/', $this->url());
        $maxIndex = count($e);
        $this->merge([
            'slug' => $e[$maxIndex - 4],
            'lesson_id' => $e[$maxIndex - 1],
        ]);
    }

    public function rules(): array
    {
        return [
            'slug' => 'required|exists:courses',
            'lesson_id' => 'required|exists:course_module_lessons,id',
        ];
    }

}
