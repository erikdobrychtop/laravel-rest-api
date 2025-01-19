<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fermenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brewery_id',
    ];

    public function brewery()
    {
        return $this->belongsTo(Brewery::class);
    }
}