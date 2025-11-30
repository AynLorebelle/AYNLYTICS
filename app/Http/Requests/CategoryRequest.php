<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge(['name' => trim($this->input('name'))]);
        }
        if ($this->has('icon')) {
            $this->merge(['icon' => trim($this->input('icon'))]);
        }
        if ($this->has('color')) {
            $this->merge(['color' => trim($this->input('color'))]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:expense,income'],
            'icon' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required.',
            'type.in' => 'Category type must be either expense or income.',
        ];
    }
}
