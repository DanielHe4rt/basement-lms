<?php


namespace LMS\Auth\Repositories;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\UnauthorizedException;
use LMS\Auth\Mail\SendGreetings;
use LMS\Auth\Models\User;

class AuthRepository
{

    public function register(array $payload)
    {
        return DB::transaction(function () use ($payload) {
            $user = User::create($payload);
            $this->sendGreetingsMail($user);
            return $user;
        });
    }

    private function sendGreetingsMail($user): void
    {
        if (config('app.env') == 'production') {
            Mail::to($user->email)->send(new SendGreetings($user));
        }
    }

    public function authenticate(array $payload)
    {

        if (!Auth::attempt($payload)) {
            throw new UnauthorizedException();
        }
        Auth::user()->seen();
        return true;
    }

    public function logout()
    {
        Auth::logout();
        return true;
    }
}
