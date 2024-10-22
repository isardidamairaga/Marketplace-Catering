<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MerchantProfile extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'description',
        'address',
        'phone',
        'logo',
    ];

    /**
     * Get the user that owns the merchant profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

