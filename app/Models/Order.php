<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_NEW = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_SHIPPED = 3;
    const STATUS_PAID = 4;
    const STATUS_CANCELED = 5;
    const STATUS_REJECTED = 6;

    const PAYMENT_CASH_ON_DELVIREY = 1;
    const PAYMENT_PAYPAL = 2;



    protected $fillable = [
        'user_id',
        'status',
        'payment_method',
        'payment_status',
        'address',
        'notes',
        'subtotal',
        'vat',
        'total',
        'coupon_id'
    ];

    
    // Apending values to Json....
    // THESE ARE A NEW FEATURES THAT WE ADD IT TO THE MODEL, 
    // THESE ARN'T A FIELDS IN THE TABLE IN DB....

    protected $appends = ['status_text', 'payment_method_text'];

    protected function statusText(): Attribute
    {
        return new Attribute(
            get: function(){
                switch ($this->status) {
                    case self::STATUS_NEW :  // == case 1:
                        return 'New Order';  
                        break;               // there is no need for this line, because we use return, it will break the method
                    
                        case self::STATUS_IN_PROGRESS :
                        return 'Preparing Order';
                        break;
                    
                    case self::STATUS_SHIPPED :
                        return 'Order Shipped';
                        break;
                    
                    case self::STATUS_PAID :
                        return 'Paid is done';
                        break;
                    
                    case self::STATUS_CANCELED :
                        return 'Order is cancelled';
                        break;
                    
                    case self::STATUS_REJECTED :
                        return 'Order is Rejected';
                        break;
                    
                    default:
                        'there is something wrong';
                        break;
                }
            }
        );
    }

    protected function paymentMethodText(): Attribute
    {
        return new Attribute(
            get: function(){
                switch ($this->payment_method) {
                    case self::PAYMENT_CASH_ON_DELVIREY :  // == case 1:
                        return 'cash on deleviry';
                        break;
                    
                    case self::PAYMENT_PAYPAL :  // == case 1:
                        return 'paypal';
                        break;
                    
                    default:
                        'another way';
                        break;
                }
            }
        );
    }
   //------------------------------------------------------


    // Relation
    public function products()
    {
        return $this->belongsToMany(product::class)->withPivot( ['quantity', 'price', 'total']);
    } 
    // the relation that return the products that belongs to this order

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // the relation that return the user who own this order
    //------------------------------------------------------
}
