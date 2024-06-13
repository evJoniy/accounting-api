<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="ShowRequest",
 *      type="object",
 *      title="Show Request",
 *      required={"id"},
 *      properties={
 *         @OA\Property(property="id", type="integer", example=1, description="The ID of the transaction")
 *      }
 *  )
 * /
 */
class ShowRequest extends FormRequest
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
            'id' => 'required|integer|exists:transactions,id',
        ];
    }
}
