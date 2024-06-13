<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="Transaction",
 *     type="object",
 *     title="Transaction",
 *     properties={
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="authod_id", type="number", example=10),
 *         @OA\Property(property="amount", type="number", example=100.00),
 *         @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00Z"),
 *         @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T00:00:00Z"),
 *         @OA\Property(property="deleted_at", type="string", format="date-time", example="2024-01-01T00:00:00Z")
 *     }
 * )
 */
class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'amount',
        'author_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
