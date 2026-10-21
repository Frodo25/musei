<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Observers\ExhibitObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy; // Не забудьте импорт

#[ObservedBy([ExhibitObserver::class])]
class Exhibit extends Model
{
   
}
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected function coverUrl(): Attribute
    {
        return Attribute::get(fn () => $this->cover
            ? asset('storage/' . $this->cover)
            : asset('images/no-cover.png'));
    }
}