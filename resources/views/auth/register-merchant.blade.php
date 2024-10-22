<x-guest-layout>
    <form method="POST" action="" enctype="multipart/form-data"  ">
        @csrf
        
        <input type="hidden" name="role" value="merchant" >
        <div>
            <x-input-label for="name" value="Contact Person Name" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus class="w-full"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required class="w-full"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Merchant Profile Information -->
        <div class="mt-4">
            <x-input-label for="company_name" value="Company Name" />
            <x-text-input id="company_name" type="text" name="company_name" :value="old('company_name')" required class="w-full" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" value="Business Description" />
            <textarea id="description" name="description" 
                      class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                      required>{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="address" value="Business Address" />
            <x-text-input id="address" type="text" name="address" :value="old('address')" required class="w-full"/>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" value="Business Phone" />
            <x-text-input id="phone" type="text" name="phone" :value="old('phone')" required class="w-full"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="logo" value="Business Logo" />
            <input id="logo" type="file" name="logo" class="w-full" accept="image/*"  />
            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" type="password" name="password" required class="w-full"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required  class="w-full"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">
                Already registered?
            </a>

            <x-primary-button class="ml-4">
                Register
            </x-primary-button>
        </div>
        
    </form>
</x-guest-layout>