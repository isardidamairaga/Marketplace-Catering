<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MerchantController extends Controller
{
    public function profile()
    {
        $merchant = auth()->user()->merchant;
        return view('merchant.profile', compact('merchant'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $merchant = auth()->user()->merchant;
        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            if ($merchant->logo) {
                Storage::delete($merchant->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $merchant->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
