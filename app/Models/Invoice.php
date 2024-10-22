<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'order_id',
        'subtotal',
        'tax',
        'total',
        'status',
        'due_date',
        'notes'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Generate nomor invoice
    public static function generateInvoiceNumber(): string
    {
        $lastInvoice = self::latest()->first();
        $number = $lastInvoice ? intval(substr($lastInvoice->invoice_number, -6)) + 1 : 1;
        return 'INV-' . date('Ymd') . '-' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }
}
