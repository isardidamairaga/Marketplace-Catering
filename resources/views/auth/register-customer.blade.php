<x-guest-layout>
    <form method="POST" action="{{ route('register.store.customer') }}">
        @csrf
        <input type="hidden" name="role" value="customer">

        <!-- Basic User Information -->
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

        <!-- Customer Profile Information -->
        <div class="mt-4">
            <x-input-label for="company_name" value="Office/Company Name" />
            <x-text-input id="company_name" type="text" name="company_name" :value="old('company_name')" required class="w-full" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="address" value="Office Address" />
            <x-text-input id="address" type="text" name="address" :value="old('address')" required  class="w-full"/>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" value="Office Phone" />
            <x-text-input id="phone" type="text" name="phone" :value="old('phone')" required class="w-full"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" type="password" name="password" required class="w-full"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required class="w-full" />
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