<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    // This is a Model to return data from a Pivot table(product_user)
    use HasFactory;

    // u named the model with a strange name
    // so u must give him the name of the table that it will return it's data
    // -if Model and table have the same name(like Product and products), u don't need to do this step-
    protected $table = 'product_user';

    
}
