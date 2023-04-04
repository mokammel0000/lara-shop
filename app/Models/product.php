<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name', 
        'price', 
        'stock', 
        'description', 
        'sku'
    ];

    // Apending values to Json....
    protected $appends = ['featured_photo'];

    protected function featuredPhoto(): Attribute
    {
        return new Attribute(
            get: function(){
                return $this->photos()->first()
				? asset($this->photos()->first()->path)
				: asset('uploads/Products/image-placeholder-base.png');
            }
        );
    }
    //------------------------------------




    // Mutators & Casting,
    // Accessors $ Mutators.

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => "$ $value",
        );
    }
    //-------------------------------------






    // Event, listen to any product created 
    protected static function booted()
    {
        static::created(function ($product) {
            $product->sku = rand(1000, 9999);
            $product->save();
        });
    }
    //---------------------------------------





    
    // Relation 
    // when u want to call category from product,
    // firstly, u should define this relation in the product model...
    // note that the product is the child of the category model so,
    // we use belongs to relation, also we name it categoryyyyy
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // Relation 
    // when u want to call photos from product,
    // firstly, u should define this relation in the product model...
    // note that the product is the parent of the photos model so,
    // we use has many relation, also we name it photosssss....
    public function photos()
    {
        return $this->hasmany(Photo::class);
    }
}


