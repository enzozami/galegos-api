<?php

namespace Gal\Models\Orders\DTOs;

use Illuminate\Http\Request;

final readonly class OrderDto
{
    public function __construct() {}

    public static function fromArray(Request $request): self
    {
        return new self();
    }

    public function toArray(): array
    {
        return [];
    }
}
