<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tenant extends Model
{
    use HasFactory;

    protected $guarded = [
    ];

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class)->withPivot(['room_host', 'rent_type', 'living_status', 'created_at', 'updated_at', 'deleted_at']);
    }
}
