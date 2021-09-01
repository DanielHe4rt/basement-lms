<?php

namespace LMS\Lessons\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use LMS\Courses\Models\Course;
use LMS\Lessons\Http\Requests\CreateLessonRequest;
use LMS\Lessons\Http\Requests\LessonWatchedStatusRequest;
use LMS\Lessons\Http\Requests\UpdateLessonRequest;
use LMS\Lessons\Http\Requests\UploadLessonVideoRequest;
use LMS\Lessons\Models\Lesson;
use LMS\Lessons\Repositories\LessonRepository;
use LMS\Modules\Models\Module;

class LessonsController extends Controller
{
    private LessonRepository $repository;

    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postLesson(CreateLessonRequest $request, Course $course, Module $module): JsonResponse
    {
        try {
            return response()->json($this->repository->createLesson($request->validated()));
        } catch (\Exception $exception) {
            return response()->json(
                ['error' => [$exception->getMessage()]],
                422
            );
        }

    }


    public function putLesson(UpdateLessonRequest $request)
    {
        try {
            return response()->json($this->repository->updateLesson($request->validated()));
        } catch (\Exception $exception) {
            return response()->json(
                ['error' => [$exception->getMessage()]],
                422
            );
        }
    }


    public function postLessonVideo(UploadLessonVideoRequest $request)
    {
        try {
            return response()->json($this->repository->uploadVideo($request->validated()));
        } catch (\Exception $exception) {
            return response()->json(
                ['errors' => ['e' => [$exception->getMessage()]]],
                422
            );
        }
    }

    public function putLessonStatus(LessonWatchedStatusRequest $request): JsonResponse
    {
        $result = $this->repository->handleWatchedLesson($request->validated());
        return response()->json($result);
    }

}
