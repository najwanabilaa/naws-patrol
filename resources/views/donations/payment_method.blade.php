@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/donations/payment_method.css') }}">
@endpush

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8 -mt-16 relative z-10">
    <!-- Payment Details -->
    <div class="payment-details space-y-6">
        <div class="bg-gray-50 p-4 rounded-lg">
            <p class="text-lg font-semibold mb-2">Payment Summary</p>
            <div class="space-y-2">
                <p><span class="text-gray-600">Method:</span> {{ $paymentMethod === 'bank_transfer' ? 'Transfer Bank' : 'E-Wallet' }}</p>
                <p><span class="text-gray-600">Provider:</span> {{ strtoupper($paymentType) }}</p>
                <p><span class="text-gray-600">Amount:</span> Rp {{ number_format($amount, 0, ',', '.') }}</p>
            </div>
        </div>

        @if($paymentMethod === 'bank_transfer')
        <div class="space-y-4">
            <div class="border p-4 rounded-lg">
                <p class="font-semibold mb-2">Virtual Account {{ strtoupper($paymentType) }}</p>
                <div class="bg-gray-50 p-3 rounded flex justify-between items-center">
                    <span class="font-mono text-lg">{{ $virtualAccount }}</span>
                    <button onclick="copyToClipboard('{{ $virtualAccount }}')" class="text-yellow-600 hover:text-yellow-700">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
            
            <div class="border p-4 rounded-lg">
                <p class="font-semibold mb-2">QR Code {{ strtoupper($paymentType) }}</p>
                <div class="flex justify-center">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $virtualAccount }}" 
                         alt="QR Code" 
                         class="qr-code">
                </div>
                <p class="text-center text-sm text-gray-500 mt-2">Scan QR code using the {{ strtoupper($paymentType) }} application</p>
            </div>
        </div>
        @else
        <div class="space-y-4">
            <div class="border p-4 rounded-lg">
                <p class="font-semibold mb-2">Payment ID {{ strtoupper($paymentType) }}</p>
                <div class="bg-gray-50 p-3 rounded flex justify-between items-center">
                    <span class="font-mono text-lg">{{ $virtualAccount }}</span>
                    <button onclick="copyToClipboard('{{ $virtualAccount }}')" class="text-yellow-600 hover:text-yellow-700">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
            
            <div class="border p-4 rounded-lg">
                <p class="font-semibold mb-2">QR Code {{ strtoupper($paymentType) }}</p>
                <div class="flex justify-center">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $virtualAccount }}" 
                         alt="QR Code" 
                         class="qr-code">
                </div>
                <p class="text-center text-sm text-gray-500 mt-2">Scan QR code using the {{ strtoupper($paymentType) }} application</p>
            </div>
        </div>
        @endif

        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
            <p class="text-yellow-800 font-medium mb-2">Payment Instructions:</p>
            <ol class="list-decimal list-inside space-y-1 text-sm text-yellow-800">
                @if($paymentType === 'bca')
                <li>Open the BCA Mobile application</li>
                <li>Select m-BCA</li>
                <li>Select m-Transfer</li>
                <li>Select BCA Virtual Account</li>
                <li>Enter the Virtual Account Number</li>
                <li>Check the payment details</li>
                <li>Enter the m-BCA PIN</li>
                <li>Payment completed</li>
                @elseif($paymentType === 'bni')
                <li>Open the BNI Mobile application</li>
                <li>Select Transfer</li>
                <li>Select Virtual Account Billing</li>
                <li>Enter the Virtual Account Number</li>
                <li>Confirm the payment details</li>
                <li>Enter the transaction password</li>
                <li>Payment completed</li>
                @elseif($paymentType === 'bri')
                <li>Open the BRImo application</li>
                <li>Select Payment</li>
                <li>Select BRIVA</li>
                <li>Enter the Virtual Account Number</li>
                <li>Check the payment details</li>
                <li>Enter the PIN</li>
                <li>Payment completed</li>
                @elseif($paymentType === 'gopay')
                <li>Open the Gojek application</li>
                <li>Select Pay</li>
                <li>Scan QR Code or enter the Payment ID</li>
                <li>Check the payment details</li>
                <li>Select Pay</li>
                <li>Enter the GoPay PIN</li>
                <li>Payment completed</li>
                @elseif($paymentType === 'ovo')
                <li>Open the OVO application</li>
                <li>Select Scan QR</li>
                <li>Scan QR Code or enter the Payment ID</li>
                <li>Check the payment details</li>
                <li>Select Pay</li>
                <li>Enter the OVO PIN</li>
                <li>Payment completed</li>
                @elseif($paymentType === 'dana')
                <li>Open the DANA application</li>
                <li>Select Scan</li>
                <li>Scan QR Code or enter the Payment ID</li>
                <li>Check the payment details</li>
                <li>Select Pay</li>
                <li>Enter the DANA PIN</li>
                <li>Payment completed</li>
                @endif
            </ol>
        </div>

        <div class="text-center">
            <p class="text-sm text-gray-600">Payment will be confirmed in:</p>
            <p class="font-medium text-lg" id="paymentTimer">1:00</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Start countdown timer
let timeLeft = 60; // 1 minute in seconds
const timerDisplay = document.getElementById('paymentTimer');
const timerId = setInterval(() => {
    timeLeft--;
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

    if (timeLeft <= 0) {
        clearInterval(timerId);
        // Redirect to success page
        window.location.href = "{{ route('donations.success', ['donation' => $donationId]) }}";
    }
}, 1000);

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Virtual Account Number successfully copied!');
    }).catch(err => {
        console.error('Failed to copy: ', err);
    });
}
</script>
@endpush

@endsection

