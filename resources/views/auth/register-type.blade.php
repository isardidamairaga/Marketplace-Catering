<x-guest-layout>
    <div class=" flex flex-col sm:justify-center items-center p-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h2 class="text-2xl font-bold text-center mb-6">Choose Registeration Type</h2>
            
            <div class="space-y-4">
                <a href="{{ route('register.merchant') }}" 
                   class="w-full block px-4 py-3 bg-blue-500 text-white text-center rounded-md hover:bg-blue-600 transition">
                    Merchant (Catering)
                </a>

                <a href="{{ route('register.customer') }}" 
                   class="w-full block px-4 py-3 bg-green-500 text-white text-center rounded-md hover:bg-green-600 transition">
                    Customer (Office)
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>