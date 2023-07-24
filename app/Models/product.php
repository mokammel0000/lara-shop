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
        'sku',
        'name', 
        'description', 
        'price', 
        'stock', 
        'views'
    ];

    
    // Apending values to Json....
    // THESE ARE A NEW FEATURES THAT WE ADD IT TO THE MODEL, 
    // THESE ARN'T A FIELDS IN THE TABLE IN DB....

    protected $appends = ['featured_photo', 'price_with_sign'];

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

    protected function priceWithSign(): Attribute
    {
        return new Attribute(
            get: function(){
                return "$this->price $";
            }
        );
    }
    //--------------------------------------------------------------------------------------




    // Mutators & Casting,
    // Accessors $ Mutators.
    // THESE ARE FIELDS IN THE DATABASE, BUT WE ATTEMPT TO CUTOMIZATIO THE RETURNING VALUE

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
        );
        // return Attribute::make(
        //     get: fn (string $value) => "$ $value",
        // );
    }
    //--------------------------------------------------------------------------------------



    // Event, listen to any product created 
    // WHEN WE CREATE ANY PRODUCT, DO THIS EVENT AUTOMATICALLY...
    protected static function booted()
    {
        static::created(function ($product) {
            $product->sku = rand(1000, 9999);
            $product->save();
        });
    }
    //--------------------------------------------------------------------------------------



    // Relations

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // when u want to call category from product,
    // firstly, u should define this relation in the product model...
    // note that the product is the child of the category model so,
    // we use belongs to relation, also we name it categoryyyyy

    
    public function photos()
    {
        return $this->hasmany(Photo::class);
    }
    // when u want to call photos from product,
    // firstly, u should define this relation in the product model...
    // note that the product is the parent of the photos model so,
    // we use has many relation, also we name it photosssss....
    
    
    // public function carts()
    // {
    //     return $this->belongsToMany(Cart::class);
    // }
    // Is there any need to call cart relation from product model?!
    // I think NO, expect you are inted to
    // make a report for the admin with the number of carts that has added this product


    public function user()  
    {
        return $this->belongsToMany(User::class)->withPivot(['rating', 'comment']);
        
        /*
        return $this->belongsToMany(User::class)->withPivot(['rating', 'comment'])
                                                ->wherePivotNotNull('comment');
        
        return $this->belongsToMany(User::class)->withPivot(['rating', 'comment'])
                                                ->as('comment')
                                                ->wherePivotNotNull('comment');
        */
    }
    // it returns User object,
    // and u can return the pivot attributes (comment and rating) that's located in product_user table.

    // Important Notes: 
        // The relation name is user, it returns user object, 
        // we call it user because we will use it to return the user user, 
        // then after calling it, u can fetch the comment from the pivot, [it don't return the comment directly...]

        // so, u can name the function as you want, but don't forget what's the object that it will return.

        // u can to return specific records from the pivot table, 
        // also u can return records from the pivot table in an ordered way, 
        // also u can aliasing the pivot table and put the name that u want.

    public function flashDeals()
    {
        return $this->hasmany(FlashDeal::class);
    }
    //--------------------------------------------------------------------------------------
}


