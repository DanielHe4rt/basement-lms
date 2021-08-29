<?php


namespace LMS\Modules\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use LMS\Modules\Http\Requests\CreateModuleRequest;
use LMS\Courses\Models\Course;
use LMS\Modules\Http\Requests\UpdateModuleRequest;
use LMS\Modules\Models\Module;
use LMS\Modules\Repositories\ModuleRepository;

class ModulesController
{
    private ModuleRepository $repository;

    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getCourseModule(Request $request, Course $course, Module $module)
    {
        $result = $this->repository->find($course, $module);
        return response()->json($result);
    }

    public function postCourseModule(CreateModuleRequest $request, Course $course): JsonResponse
    {
        $payload = $request->validated();
        $result = $this->repository->createModule($course, $payload);

        return response()->json($result, Response::HTTP_CREATED);
    }

    public function putCourseModule(UpdateModuleRequest $request, Course $course, Module $module)
    {
        $payload = $request->validated();
        $result = $this->repository->update($module, $payload);

        return response()->json($result);
    }

    public function deleteCourseModule(Course $course, Module $module): JsonResponse
    {
        try {
            $this->repository->deleteModule($course, $module);
            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (UnauthorizedException $exception) {
            return response()->json([
                'errors' => [
                    'exception' => ['Você não tem permissão para apagar esse módulo!']
                ]
            ], Response::HTTP_UNAUTHORIZED);
        }


    }
}
