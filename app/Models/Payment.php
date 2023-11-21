<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Payment extends Model
{
    use HasFactory;

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function roomApartment(): HasOneThrough
    {
        return $this->hasOneThrough(Apartment::class, Room::class);
    }
}
