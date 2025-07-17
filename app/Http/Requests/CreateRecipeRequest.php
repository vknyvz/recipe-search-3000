<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRecipeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'author_email' => 'required|email|max:255',
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'required|string|max:500',
            'steps' => 'required|array|min:1',
            'steps.*' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The recipe name is required.',
            'name.max' => 'The recipe name must not exceed 255 characters.',
            'description.required' => 'The recipe description is required.',
            'description.max' => 'The description must not exceed 1000 characters.',
            'author_email.required' => 'The author email is required.',
            'author_email.email' => 'The author email must be a valid email address.',
            'ingredients.required' => 'At least one ingredient is required.',
            'ingredients.min' => 'At least one ingredient is required.',
            'ingredients.*.required' => 'Each ingredient description is required.',
            'ingredients.*.max' => 'Each ingredient must not exceed 500 characters.',
            'steps.required' => 'At least one step is required.',
            'steps.min' => 'At least one step is required.',
            'steps.*.required' => 'Each step description is required.',
            'steps.*.max' => 'Each step must not exceed 1000 characters.',
        ];
    }
}
