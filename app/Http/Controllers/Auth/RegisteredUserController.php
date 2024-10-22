<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role']
            ]);
    
            if ($data['role'] === 'merchant') {
                MerchantProfile::create([
                    'user_id' => $user->id,
                    'company_name' => $data['company_name'],
                    'address' => $data['address'],
                    'phone' => $data['phone']
                ]);
            } else {
                CustomerProfile::create([
                    'user_id' => $user->id,
                    'company_name' => $data['company_name'],
                    'address' => $data['address'],
                    'phone' => $data['phone']
                ]);
            }
    
            return $user;
        });
    }
}
