<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColdRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brewery_id',
    ];

    // Relacionamento com Brewery
    public function brewery()
    {
        return $this->belongsTo(Brewery::class);
    }

    // Relacionamento com ColdRoomTemperature
    public function temperatures()
    {
        return $this->hasMany(ColdRoomTemperature::class);
    }
}
