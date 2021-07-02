<?php


namespace LMS\Courses\Http\Requests;


class CreateCourseRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'course_level_id' => 'required|exists:course_levels',
            'title' => 'required|string|max:60',
            'subtitle' => 'required|string|max:120',
            'description' => 'required|string',
            'cover' => 'required|mimes:png,jpeg',
            'paid' => 'required|bool',
        ];
    }

}
