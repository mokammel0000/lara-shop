<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'path', 
        'product_id'
    ];

     
    
    public function user()
    {
        return $this->belongsTo(product::class);
    }

}
