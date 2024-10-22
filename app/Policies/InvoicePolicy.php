<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceService
{
    public function generateInvoice(Order $order): Invoice
    {
        $subtotal = $order->total_amount;
        $tax = $subtotal * 0.11; // PPN 11%
        $total = $subtotal + $tax;

        return Invoice::create([
            'invoice_number' => Invoice::generateInvoiceNumber(),
            'order_id' => $order->id,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'status' => 'unpaid',
            'due_date' => Carbon::now()->addDays(7),
            'notes' => 'Payment due within 7 days'
        ]);
    }
}
