<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    use HasFactory;

    const TYPE_FIXED = 1;
    const TYPE_PERCENT = 2;

    protected $fillable = [
        'code',
        'type',
        'discount',
        'redeems',
        'active',
    ];

    protected $appends = [
        'type_of_coupon', 
        'discount_with_sign'
    ];

    protected function TypeOfCoupon(): Attribute
    {
        return new Attribute(
            get: function(){
                switch ($this->type) {
                    case Self::TYPE_FIXED:
                        return 'Fixed';
                        break;
                    
                    case Self::TYPE_PERCENT:
                        return 'Percent';
                        break;

                    default:
                        return 'Other';
                        break;
                }
            }
        );
    }

    protected function DiscountWithSign(): Attribute
    {
        return new Attribute(
            get: function(){
                switch ($this->type) {
                    case SELF::TYPE_FIXED:
                        return "$this->discount EG";
                        break;

                    case SELF::TYPE_PERCENT:
                        return "$this->discount %";
                        break;
                    
                    default:
                        return 'this is not specified type';
                        break;
                }
            }
        );
    }
}
