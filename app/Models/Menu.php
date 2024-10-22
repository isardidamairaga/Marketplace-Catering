<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'merchant_id',
        'name',
        'description',
        'price',
        'image',
        'is_available',
    ];

    public function merchant()
    {
        return $this->belongsTo(MerchantProfile::class);
    }
}
