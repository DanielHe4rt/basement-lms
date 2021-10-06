<?php

namespace LMS\User\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class MeRepository
{
    public function updateBaseInformation(array $payload): bool
    {
        $address = $payload['address'];
        unset($payload['address']);
        $user = Auth::user();
        $user->update($payload);
        $user->address()->update($address);
        return true;
    }

    public function updateProfilePicture()
    {
        Auth::user()->clearMediaCollection();
        return Auth::user()->addMediaFromRequest('image')->toMediaCollection();
    }
}
