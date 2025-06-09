@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="mb-8">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Payment Success!</h1>
                <p class="text-gray-600">Thank you for your donation</p>
                <p class="text-2xl font-bold text-yellow-600 mt-2">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h2 class="text-lg font-semibold mb-4">Transaction Details</h2>
                <div class="space-y-3 text-left">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Transaction ID</span>
                        <span class="font-medium">{{ $donation->transaction_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Date</span>
                        <span class="font-medium">{{ $donation->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status</span>
                        <span class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-800">
                            {{ ucfirst($donation->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <p class="text-gray-600 mb-4">Total donations collected</p>
                <p class="text-3xl font-bold text-yellow-600 mb-8">Rp {{ number_format($totalDonations, 0, ',', '.') }}</p>
                <a href="{{ route('donations.index') }}" class="inline-block bg-yellow-500 text-white py-2 px-6 rounded-md hover:bg-yellow-600 transition duration-200">
                    Back to Donation Page
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 