<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FermenterTemperature extends Model
{
    use HasFactory;

    protected $fillable = [
        'fermenter_id',
        'recorded_at',
        'min_temperature',
        'max_temperature',
    ];

    public function fermenter()
    {
        return $this->belongsTo(Fermenter::class);
    }
}