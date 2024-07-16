<?php

namespace App\Requests;

class TransactionRequest extends CustomRulesRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function validateToStore(): array
    {
        return [
            'amount' => 'required|string',
            'timestamp' => 'required|date_format:Y-m-d\\TH:i:s.vp',
        ];

    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'The amount field is required.',
            'amount.string' => 'The amount field must be a string.',
            'timestamp.required' => 'The timestamp field is required.',
            'timestamp.date_format' => 'The timestamp field must match the format Date ISO8601.',
        ];
    }
}
