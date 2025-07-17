<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeSearchRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'nullable|email|max:255',
            'keyword' => 'nullable|string|max:255',
            'ingredient' => 'nullable|string|max:255',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'The email must be a valid email address.',
            'keyword.max' => 'The keyword must not exceed 255 characters.',
            'ingredient.max' => 'The ingredient must not exceed 255 characters.',
            'page.integer' => 'The page must be a valid number.',
            'page.min' => 'The page must be at least 1.',
            'per_page.integer' => 'The per_page must be a valid number.',
            'per_page.min' => 'The per_page must be at least 1.',
            'per_page.max' => 'The per_page must not exceed 100.',
        ];
    }

    public function getSearchFilters(): array
    {
        return array_filter([
            'email' => $this->validated('email'),
            'keyword' => $this->validated('keyword'),
            'ingredient' => $this->validated('ingredient'),
        ], fn($value) => !is_null($value) && $value !== '');
    }

    public function getPaginationParams(): array
    {
        return [
            'page' => $this->validated('page', 1),
            'per_page' => $this->validated('per_page', 12),
        ];
    }
}
