<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'type',
        'name',
        'email',
        'password',
        'phone',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //------------------------------------




    // Mutators & Casting,
    // Accessors $ Mutators.
    protected function password(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => ucfirst($value), // we don't need Accessor here
            
            // We only need the Mutator
            set: fn (string $value) => Hash::make($value),
        );
    }
    //------------------------------------
    
    
    //Relation
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    // the relation that return the cart that belongs to this user
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    // the relation that return the ordres that belongs to this user

    public function product()
    {
        return $this->belongsToMany(Product::class);        
        return $this->belongsToMany(Product::class)->withPivot(['rating', 'comment']);  
    }
    // the relation that return product object (Many to Many Relationship),
    // u can return the pivot attributes (comment and rating) that's located in product_user table.
    //------------------------------------
    
}
