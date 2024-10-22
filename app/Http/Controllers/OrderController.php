<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'delivery_date' => 'required|date|after:today',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $order = Order::create([
                'customer_id' => auth()->user()->customer->id,
                'merchant_id' => $request->merchant_id,
                'delivery_date' => $request->delivery_date,
                'status' => 'pending',
                'total_amount' => 0,
            ]);

            $total = 0;
            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                $subtotal = $menu->price * $item['quantity'];
                $total += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $item['quantity'],
                    'price' => $menu->price,
                ]);
            }

            $order->update(['total_amount' => $total]);

            DB::commit();

            return redirect()->route('customer.orders.show', $order)
                ->with('success', 'Order placed successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function customerOrders()
    {
        $orders = auth()->user()->customer->orders()->latest()->paginate(10);
        return view('customer.orders.index', compact('orders'));
    }

    public function merchantOrders()
    {
        $orders = auth()->user()->merchant->orders()->latest()->paginate(10);
        return view('merchant.orders.index', compact('orders'));
    }
}
