<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="StoreRequest",
 *      type="object",
 *      title="Store Request",
 *      required={"amount", "author_id"},
 *      properties={
 *          @OA\Property(property="title", type="string", nullable=true),
 *          @OA\Property(property="amount", type="float", example=100),
 *          @OA\Property(property="author_id", type="integer", example=1)
 *      }
 *  )
 * /
 */
class StoreRequest extends FormRequest
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
            'title' => 'nullable|string',
            'amount' => 'required|float',
            'author_id' => 'required|exists:users,id',
        ];
    }
}
