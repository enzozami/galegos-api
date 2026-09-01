<?php

namespace Gal\Models\User;

use Database\Factories\UserFactory;
use Gal\Base\Traits\HasUuidRouteKey;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password', 'birth_date', 'phone_number', 'cpf'])]
#[Hidden(['id', 'password', 'remember_token', 'type', 'status'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasUuids, HasApiTokens, HasUuidRouteKey {
        HasUuidRouteKey::uniqueIds insteadof HasUuids;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'birth_date' => 'date',
            'phone_number' => 'string',
            'cpf' => 'string',
            'last_order' => 'datetime',
        ];
    }
}
