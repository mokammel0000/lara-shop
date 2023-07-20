<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashDeal extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'deal_percent', 
        'duaration',
        // 'active',     // then we can't use it in the Mass Assignment
        'photo_path', 
        'product_id', 
    ];

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
