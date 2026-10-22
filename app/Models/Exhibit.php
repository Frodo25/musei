<?php

namespace App\Models;

use App\Observers\ExhibitObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([ExhibitObserver::class])]
class Exhibit extends Model
{
    protected $fillable = [
        'hall_id',
        'title',
        'author',
        'year',
        'description',
        'cover',
        'user_id',
    ];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}