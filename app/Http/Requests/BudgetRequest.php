<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('amount')) {
            $this->merge(['amount' => str_replace([',',' '], ['','.'], trim((string) $this->input('amount')))]);
        }
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'month' => ['required', 'integer', 'between:1,12'],
            'year' => ['required', 'integer', 'min:1900'],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.numeric' => 'Please enter a valid amount.',
            'month.between' => 'Month must be between 1 and 12.',
        ];
    }
}
