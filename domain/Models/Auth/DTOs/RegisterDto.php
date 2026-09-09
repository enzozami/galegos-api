<?php

namespace Gal\Models\Auth\DTOs;

use Illuminate\Http\Request;

final readonly class RegisterDto
{
    public function __construct(
        public string $email,
        public string $password,
        public string $name,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            email: $request->string('email')->toString(),
            password: $request->string('password')->toString(),
            name: $request->string('name')->toString(),
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'name' => $this->name,
        ];
    }
}
