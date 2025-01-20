<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'batch', 
        'map_register', 
        'production_date',
        'abv', 
        'ibu', 
        'mash_brix', 
        'pre_boil_brix', 
        'post_boil_brix', 
        'fermenter_id'
    ];
    
    // Adicionar a relação com o fermentador
    public function fermenter()
    {
        return $this->belongsTo(Fermenter::class);
    }

    public function ingredients()
    {
        return $this->hasMany(BatchIngredient::class);
    }

    public function densities()
    {
        return $this->hasMany(BatchDensity::class);
    }
}