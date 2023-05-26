<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    protected $table = 'accidents';
    use HasFactory;
    protected $fillable = [
        'description',
        'status_id',
        'user_id',
        'incident_id',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
