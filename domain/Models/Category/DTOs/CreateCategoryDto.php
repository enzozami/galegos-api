<?php

namespace Gal\Models\Category\DTOs;

use Illuminate\Http\Request;

final readonly class CreateCategoryDto
{
    public function __construct(
        public string $name,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->string('name')->toString(),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}