@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/donations/payment_method.css') }}">
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">Donations for Naw's Patrol</h1>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold">Total Donations Collected</h2>
                <p class="text-3xl font-bold text-yellow-600">Rp {{ number_format($totalDonations, 0, ',', '.') }}</p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('donations.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-yellow-500">
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-yellow-500">
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-yellow-500">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-yellow-500">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Donation Amount (Rp)</label>
                    <input type="number" name="amount" value="{{ old('amount', 10000) }}" min="1000" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-yellow-500">
                    @error('amount')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                    <select name="payment_method" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-yellow-500" required>
                        <option value="">Select payment method</option>
                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="ewallet" {{ old('payment_method') == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                    </select>
                    @error('payment_method')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div id="bankOptions">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Bank</label>
                    <select name="bank_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-yellow-500">
                        <option value="">Select bank</option>
                        <option value="bca" {{ old('bank_type') == 'bca' ? 'selected' : '' }}>BCA</option>
                        <option value="bni" {{ old('bank_type') == 'bni' ? 'selected' : '' }}>BNI</option>
                        <option value="bri" {{ old('bank_type') == 'bri' ? 'selected' : '' }}>BRI</option>
                    </select>
                    @error('bank_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div id="ewalletOptions">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select E-Wallet</label>
                    <select name="ewallet_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-yellow-500">
                        <option value="">Select e-wallet</option>
                        <option value="gopay" {{ old('ewallet_type') == 'gopay' ? 'selected' : '' }}>GoPay</option>
                        <option value="ovo" {{ old('ewallet_type') == 'ovo' ? 'selected' : '' }}>OVO</option>
                        <option value="dana" {{ old('ewallet_type') == 'dana' ? 'selected' : '' }}>DANA</option>
                    </select>
                    @error('ewallet_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 transition duration-200">
                    Continue Payment
                </button>
            </form>
        </div>

        @if($userDonations->count() > 0)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Your Donation History</h2>
            <div class="space-y-4">
                @foreach($userDonations as $donation)
                <div class="border-b pb-4 last:border-b-0 last:pb-0">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">{{ $donation->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 text-sm rounded-full 
                                @if($donation->status == 'success') bg-green-100 text-green-800
                                @elseif($donation->status == 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-[500px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4 text-center">Payment Details</h3>
            <div id="paymentDetails" class="mt-4"></div>
            <div class="mt-6 text-center">
                <button id="closeModal" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition-colors">
                    Close   
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/donations/payment_method.js') }}"></script>
@endpush

@endsection 