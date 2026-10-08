<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    protected function prepareForValidation(): void
    {
        if (empty($this->slug) && ! empty($this->name)) {
            $this->merge([
                'slug' => Str::slug($this->name),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:200', 'unique:products,slug'],
            'sku' => ['required', 'string', 'max:80', 'unique:products,sku'],
            'description' => ['nullable', 'string'],
            'material' => ['nullable', 'string', 'max:100'],
            'care_instructions' => ['nullable', 'string'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'compare_at_price' => ['nullable', 'numeric', 'min:0'],
            'is_featured' => ['boolean'],
            'is_best_seller' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }
}
