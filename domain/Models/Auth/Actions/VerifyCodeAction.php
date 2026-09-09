<?php

namespace Gal\Models\Auth\Actions;

use Gal\Models\Auth\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class VerifyCodeAction
{

    private const int MAX_ATTEMPTS = 5;

    public function handle(string $email, string $code): string
    {
        $passwordReset = PasswordReset::query()
            ->where('email', $email)
            ->where('expires_at', '>', now())
            ->orderByDesc('id')
            ->first();

        if (!$passwordReset) {
            throw new \Exception('Código inválido ou expirado.');
        }

        if ($passwordReset->attempts >= self::MAX_ATTEMPTS) {
            $passwordReset->delete();
            throw new \Exception('Número máximo de tentativas atingido.');
        }

        if (!Hash::check($code, $passwordReset->code)) {
            $passwordReset->increment('attempts');
            throw new \Exception('Código inválido.');
        }

        $resetToken = Str::random(64);

        $passwordReset->update([
            'reset_token' => Hash::make($resetToken),
            'verified_at' => now(),
        ]);

        return $resetToken;
    }
}
