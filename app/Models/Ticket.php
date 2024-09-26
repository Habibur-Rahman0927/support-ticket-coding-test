<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory;

    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Relationship: A ticket belongs to a user (who created the ticket).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A ticket has many responses.
     */
    public function response(): HasOne
    {
        return $this->hasOne(TicketResponse::class);
    }

    /**
     * Relationship: A ticket was created by a user.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship: A ticket was updated by a user (if applicable).
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
