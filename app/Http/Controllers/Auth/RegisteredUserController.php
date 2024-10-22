<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CustomerProfile;
use App\Models\MerchantProfile;
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
        return view('auth.register-type');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  
        public function createMerchant(): View
        {
            return view('auth.register-merchant');
        }
    
        public function createCustomer(): View
        {
            return view('auth.register-customer');
        }
    
        public function storeMerchant(Request $request)
        {
            
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'company_name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:15'],
            ]);
    
           
            $user = DB::transaction(function () use ($request) {
                // Buat pengguna
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'merchant',
                ]);
               
    
                // Buat profil Merchant
                MerchantProfile::create([
                    'user_id' => $user->id,
                    'company_name' => $request->company_name,
                    'description'=> $request->description,
                    'address' => $request->address,
                    'phone' => $request->phone,
                ]);
    
                return $user;
            });
    
         
            event(new Registered($user));
    
    
            Auth::login($user);
    
            // Redirect to the dashboard
            return redirect(route('dashboard', absolute: false));
        }
    
        public function storeCustomer(Request $request)
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
    
      
            $user = DB::transaction(function () use ($request) {

                // Buat pengguna
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'customer',
                ]);
    
                // Buat profil Customer
                CustomerProfile::create([
                    'user_id' => $user->id,
                    'company_name' => $request->company_name,
                    'address' => $request->address,
                    'phone' => $request->phone,
              
                ]);
    
                return $user;
            });
    
            
            event(new Registered($user));
    
           
            Auth::login($user);
    
           
            return redirect(route('dashboard', absolute: false));
        }
}
    
