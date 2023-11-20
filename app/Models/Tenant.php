<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tenant extends Model
{
    use HasFactory;

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class);
    }
}
