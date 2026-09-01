<?php

namespace Gal\Models\Auth\Actions;

use Gal\Models\Auth\DTOs\LoginDto;
use Gal\Models\User\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class LoginAction
{
    public function handle(LoginDto $dto, Request $request): User
    {
        if (! Auth::guard('web')->attempt($dto->toArray(), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::guard('web')->user();

        return $user;
    }
}
