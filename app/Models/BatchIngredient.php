<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id', 'name', 'stage', 'quantity', 'value', 'temperature',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
