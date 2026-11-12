<?php

namespace Gal\Models\Category\Requests;

use Gal\Models\Category\Enums\CategoryStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('category'));
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($this->route('category'))],
            'status' => ['sometimes', Rule::enum(CategoryStatusEnum::class)],
        ];
    }
}