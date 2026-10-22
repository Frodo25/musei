<?php

namespace App\Models;

use App\Observers\HallObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([HallObserver::class])]
class Hall extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function exhibits(): HasMany
    {
        return $this->hasMany(Exhibit::class);
    }
}