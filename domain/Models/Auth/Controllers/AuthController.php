<?php

namespace Gal\Models\Auth\Controllers;

use App\Http\Controllers\Controller;
use Gal\Models\Auth\Actions\LoginAction;
use Gal\Models\Auth\Actions\LogoutAction;
use Gal\Models\Auth\DTOs\LoginDto;
use Gal\Models\Auth\Requests\LoginRequest;
use Gal\Models\User\Resource\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $action): UserResource
    {
        $user = $action->handle(LoginDto::fromRequest($request), $request);

        return new UserResource($user);
    }

    public function logout(Request $request, LogoutAction $action): Response
    {
        $action->handle($request);

        return response()->noContent();
    }
}
