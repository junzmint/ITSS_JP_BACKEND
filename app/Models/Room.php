<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    public function room_type(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
    public function room_medias(): HasMany
    {
        return $this->hasMany(RoomMedia::class);
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class)->withPivot(['room_host', 'rent_type', 'living_status', 'created_at', 'updated_at', 'deleted_at']);
    }
}
