<?php


namespace LMS\Courses\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'course_level_id' => 'required|exists:course_levels,id',
            'title' => 'required|string|max:60',
            'subtitle' => 'required|string|max:120',
            'description' => 'required|string',
            'cover' => 'required|mimes:png,jpeg',
            'paid' => 'required|bool',
            'slug' => 'string'
        ];
    }

}
