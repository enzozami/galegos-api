<?php

namespace Gal\Models\Auth\Controllers;

use App\Http\Controllers\Controller;
use Gal\Models\Auth\Actions\ForgotPasswordAction;
use Gal\Models\Auth\Actions\LoginAction;
use Gal\Models\Auth\Actions\LogoutAction;
use Gal\Models\Auth\Actions\ResetPasswordAction;
use Gal\Models\Auth\Actions\VerifyCodeAction;
use Gal\Models\Auth\DTOs\LoginDto;
use Gal\Models\Auth\Requests\ForgotPasswordRequest;
use Gal\Models\Auth\Requests\LoginRequest;
use Gal\Models\Auth\Requests\VerifyCodeRequest;
use Gal\Models\Auth\Requests\ResetPasswordRequest;
use Gal\Models\User\Resource\UserResource;
use Illuminate\Http\JsonResponse;
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

    public function forgotPassword(ForgotPasswordRequest $request, ForgotPasswordAction $action): JsonResponse
    {
        $action->handle($request->string('email')->toString());

        return response()->json(['message' => __('auth.forgot_password')]);
    }

    public function verifyCode(VerifyCodeRequest $request, VerifyCodeAction $action): JsonResponse
    {
        $resetToken = $action->handle(
            $request->string('email')->toString(),
            $request->string('code')->toString()
        );

        return response()->json(['reset_token' => $resetToken]);
    }

    public function resetPassword(ResetPasswordRequest $request, ResetPasswordAction $action): JsonResponse
    {
        $action->handle(
            $request->string('email')->toString(),
            $request->string('password')->toString(),
            $request->string('reset_token')->toString()
        );

        return response()->json(['message' => __('auth.reset_password')]);
    }
}
