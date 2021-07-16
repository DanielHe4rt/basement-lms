<?php


namespace LMS\Auth\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\UnauthorizedException;
use LMS\Auth\Http\Requests\LoginRequest;
use LMS\Auth\Http\Requests\RegisterRequest;
use LMS\Auth\Repositories\AuthRepository;

class AuthController extends Controller
{
    /**
     * @var AuthRepository
     */
    private $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postRegister(RegisterRequest $request)
    {
        $payload = $request->validated();
        try {
            $this->repository->register($payload);
            return new JsonResponse([], 201);
        } catch (\Exception $exception) {
            return new JsonResponse([$exception->getMessage()], 422);
        }
    }

    public function postAuthenticate(LoginRequest $request)
    {
        $payload = $request->validated();

        try {
            $this->repository->authenticate($payload);
        } catch (UnauthorizedException $exception) {
            return new JsonResponse([$exception->getMessage()], 401);
        }
    }

    public function getLogout()
    {
        $this->repository->logout();
        return redirect('/');
    }
}
