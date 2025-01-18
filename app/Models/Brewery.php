<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brewery extends Model
{
    use HasFactory;

    protected $fillable = [
        'corporate_name',
        'trade_name',
        'cnpj',
        'street',
        'neighborhood',
        'number',
        'zip_code',
        'city',
        'state',
    ];

    // Relacionamento com ColdRoom
    public function coldRooms()
    {
        return $this->hasMany(ColdRoom::class);
    }
}
