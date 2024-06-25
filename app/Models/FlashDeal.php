<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashDeal extends Model
{
    use HasFactory;

    // ,,,,,,created_at,updated_at
    protected $fillable = [
        'title',
        'discount_percentage',
        'original_price',
        'discounted_price',
        'duration',
        'start_at',
        'end_at',
        'active',
        'photo_path',
        'product_id',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];
    // If you include any date in your table, it will be saved as a string,
    // but we want to fetch it as a date and time, then there are 2 ways:
    // 1- fetch it as a string and then convert it manually to a carbon object in the controller.
    // 2- put the field name in the $casts array, and laravel will cast it to you to a carbon object,
    //                  then you can deal with the fetched data directly ( by default laravel do that with timestamp ).

    // take care: this way will not be worked in the dates that are fetched directly from the form,
    // it will work with the dates that are fetched from the FlashDeal table in the DB.

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
