<?php

namespace Gal\Models\Auth\Actions;

use Gal\Models\Auth\DTOs\LoginDto;
use Gal\Models\Auth\DTOs\RegisterDto;
use Gal\Models\User\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class RegisterAction
{
    public function handle(RegisterDto $dto): User
    {
        return User::create($dto->toArray());
    }
}
