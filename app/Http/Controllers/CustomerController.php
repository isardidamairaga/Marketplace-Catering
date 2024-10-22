<?php

namespace App\Http\Controllers;

use App\Models\MerchantProfile;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function searchMerchants(Request $request)
    {
        $merchants = MerchantProfile::query()
            ->when($request->search, function ($query, $search) {
                $query->where('company_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(12);

        return view('customer.merchants.index', compact('merchants'));
    }

    public function merchantDetails(MerchantProfile $merchant)
    {
        $menus = $merchant->menus()->where('is_available', true)->get();
        return view('customer.merchants.show', compact('merchant', 'menus'));
    }
}
