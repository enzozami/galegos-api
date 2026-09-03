<?php

namespace Gal\Models\Auth\Actions;

use Gal\Models\Auth\Mail\SendMail;
use Gal\Models\Auth\PasswordReset;
use Gal\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

final class ForgotPasswordAction
{
    private const int EXPIRES_IN_MINUTES = 15;

    public function handle(string $email): void
    {
        $user = User::query()->where('email', $email)->first();

        if (!$user) return;

        PasswordReset::query()->where('email', $email)->delete();

        $code = (string) random_int(min: 100000, max: 999999);

        PasswordReset::create([
            'email' => $email,
            'code' => Hash::make($code),
            'attempts' => 0,
            'expires_at' => now()->addMinutes(self::EXPIRES_IN_MINUTES),
        ]);

        Mail::to($email)->send(new SendMail($code, self::EXPIRES_IN_MINUTES));
    }
}
