<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Incident extends Model {
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function users(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'users_incidents', 'incident_id', 'user_id');
    }
    public function accidents(): HasMany
    {
        return $this->hasMany(Accident::class);
    }
}
