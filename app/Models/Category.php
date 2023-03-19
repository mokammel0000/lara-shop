<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'icon', 
        'photo'
    ];

    // Relation 
    // when u want to call products from category,
    // firstly, u should define this relation in the category model...
    // note that the category is the parent of the products model so,
    // we use has many relation, also we name it productsssss....
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
