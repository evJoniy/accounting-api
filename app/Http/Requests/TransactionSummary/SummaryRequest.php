<?php

namespace App\Http\Requests\TransactionSummary;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="SummaryRequest",
 *     type="object",
 *     title="Summary Request",
 *     required={"start_date", "end_date"},
 *     properties={
 *         @OA\Property(property="start_date", type="string", format="date", example="2024-01-01", description="The start date of the summary period"),
 *         @OA\Property(property="end_date", type="string", format="date", example="2024-12-31", description="The end date of the summary period")
 *     }
 * )
 */
class SummaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }
}
