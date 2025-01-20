<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchDensity extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id', 'density', 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
