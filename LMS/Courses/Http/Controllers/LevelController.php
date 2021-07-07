<?php


namespace LMS\Courses\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use LMS\Courses\Repositories\LevelRepository;

class LevelController extends Controller
{
    private LevelRepository $repository;

    public function __construct(LevelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getLevels(): JsonResponse
    {
        return response()->json($this->repository->getAll(), Response::HTTP_OK);
    }
}
