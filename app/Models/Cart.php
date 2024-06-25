<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];


    // Relation
    public function products()
    {
        return $this->belongsToMany(product::class)->withPivot('quantity');
    }


}
