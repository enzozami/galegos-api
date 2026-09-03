<?php

namespace Gal\Models\Auth\Actions;

use Gal\Models\Auth\PasswordReset;
use Gal\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class ResetPasswordAction
{

    public function handle(string $email, string $password, string $resetToken): void
    {

        $passwordReset = PasswordReset::query()
            ->where('email', $email)
            ->whereNotNull('reset_token')
            ->where('expires_at', '>', now())
            ->orderByDesc('id')
            ->first();

        if (!$passwordReset) {
            throw new \Exception('Token de redefinição inválido ou expirado.');
        }

        if (!$passwordReset->verified_at) {
            throw new \Exception('O código de verificação não foi validado.');
        }

        if (!Hash::check($resetToken, $passwordReset->reset_token)) {
            throw new \Exception('Token de redefinição inválido.');
        }

        User::where('email', $email)
            ->update([
                'password' => Hash::make($password)
            ]);

        $passwordReset->delete();
    }
}
