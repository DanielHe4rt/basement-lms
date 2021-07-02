<?php


namespace LMS\Courses\Http\Controllers;

use App\Http\Controllers\Controller;
use LMS\Courses\Repositories\CourseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use LMS\Courses\Http\Requests\CreateCourseRequest;

class CoursesController extends Controller
{
    private CourseRepository $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postCourse(CreateCourseRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $data = $this->repository->create($payload);

        return response()->json($data, Response::HTTP_CREATED);
    }
}
