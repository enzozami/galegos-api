<?php

namespace Gal\Models\Auth;

use Database\Factories\PasswordResetFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['email', 'code', 'reset_token', 'attempts', 'verified_at', 'expires_at'])]
#[Hidden(['id'])]
class PasswordReset extends Model
{
    protected $table = 'password_resets';

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }
}
