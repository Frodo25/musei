<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'exhibit_id',
        'phone',
        'comment',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exhibit(): BelongsTo
    {
        return $this->belongsTo(Exhibit::class);
    }
}
