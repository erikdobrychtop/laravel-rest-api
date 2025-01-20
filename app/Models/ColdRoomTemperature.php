<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColdRoomTemperature extends Model
{
    use HasFactory;

    protected $fillable = [
        'cold_room_id',
        'recorded_at',
        'temperature',
    ];

    // Relacionamento com ColdRoom
    public function coldRoom()
    {
        return $this->belongsTo(ColdRoom::class);
    }
}
