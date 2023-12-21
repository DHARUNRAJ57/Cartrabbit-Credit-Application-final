<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set authorization rules if needed
    }

    public function rules()
    {
        return [
          //  'full_name' => 'required|string',
            'pan_number' => 'nullable|string|max:10',
            'credit_score' => 'nullable|numeric',
            // Define rules for other fields in your form
            // Example: 'loan_amount' => 'required|numeric|max:1000000',
        ];
    }
}
