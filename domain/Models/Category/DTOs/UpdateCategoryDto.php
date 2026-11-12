<?php

namespace Gal\Models\Category\DTOs;

use Gal\Models\Category\Enums\CategoryStatusEnum;
use Illuminate\Http\Request;

final readonly class UpdateCategoryDto
{
    public function __construct(
        public ?string $name,
        public ?CategoryStatusEnum $status = null
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->filled('name') ? $request->string('name')->toString() : null,
            status: $request->enum('status', CategoryStatusEnum::class),
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'status' => $this->status, 
        ], fn($value) => $value !== null);
    }
}