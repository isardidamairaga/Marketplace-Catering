<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'merchant_id',
        'total_amount',
        'delivery_date',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerProfile::class);
    }

    public function merchant()
    {
        return $this->belongsTo(MerchantProfile::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice()
    {
    return $this->hasOne(Invoice::class);
    }
}