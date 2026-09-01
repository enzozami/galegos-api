<?php

namespace Gal\Models\Auth\Controllers;

use App\Http\Controllers\Controller;
use Gal\Models\Auth\Actions\LoginAction;
use Gal\Models\Auth\DTOs\LoginDto;
use Gal\Models\Auth\Requests\LoginRequest;
use Gal\Models\User\Resource\UserResource;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $action): UserResource
    {
        $user = $action->handle(LoginDto::fromRequest($request), $request);

        return new UserResource($user);
    }
}
