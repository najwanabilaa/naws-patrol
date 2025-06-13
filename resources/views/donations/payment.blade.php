@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold text-center mb-8">Payment Details</h1>

            <div class="space-y-6">
                <div class="text-center">
                    <p class="text-gray-600 mb-1">Amount to be Paid</p>
                    <p class="text-3xl font-bold text-yellow-600">Rp {{ number_format($paymentDetails['amount'], 0, ',', '.') }}</p>
                </div>

                @if($paymentDetails['payment_type'] === 'bank_transfer')
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="font-semibold text-lg mb-4">Bank Transfer {{ strtoupper($paymentDetails['bank']) }}</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-600 mb-1">Virtual Account Number:</p>
                                <div class="flex items-center justify-between bg-white p-3 rounded border">
                                    <span class="font-mono text-lg">{{ $paymentDetails['virtual_account'] }}</span>
                                    <button onclick="copyToClipboard('{{ $paymentDetails['virtual_account'] }}')" 
                                            class="text-yellow-600 hover:text-yellow-700">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <p class="font-medium">Steps:</p>
                                <ol class="list-decimal list-inside space-y-1 text-gray-600">
                                    <li>Open the m-Banking application {{ strtoupper($paymentDetails['bank']) }}</li>
                                    <li>Select the Transfer menu</li>
                                    <li>Enter the Virtual Account Number</li>
                                    <li>Make sure the transfer amount is correct</li>
                                    <li>Complete the payment</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="font-semibold text-lg mb-4">Pembayaran {{ strtoupper($paymentDetails['provider']) }}</h2>
                        
                        <div class="space-y-4">
                            <div class="text-center">
                                <img src="{{ $paymentDetails['qr_code'] }}" alt="QR Code" class="mx-auto w-48 h-48">
                                <p class="mt-2 text-gray-600">Scan QR code using the {{ strtoupper($paymentDetails['provider']) }} application</p>
                            </div>

                            <div class="space-y-2">
                                <p class="font-medium">Steps:</p>
                                <ol class="list-decimal list-inside space-y-1 text-gray-600">
                                    <li>Open the {{ strtoupper($paymentDetails['provider']) }} application</li>
                                    <li>Select the Scan QR menu</li>
                                    <li>Scan the QR code above</li>
                                    <li>Make sure the payment amount is correct</li>
                                    <li>Complete the payment</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="text-center">
                    <p class="text-gray-600">Complete the payment before:</p>
                    <div class="font-medium text-lg" id="countdown">
                        <span id="minutes">--</span>:<span id="seconds">--</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">The status will be automatically updated after the payment is received</p>
                </div>

                <div class="text-center text-sm text-gray-500">
                    ID Transaksi: {{ $paymentDetails['transaction_id'] }}
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('donations.index') }}" class="text-yellow-600 hover:text-yellow-700">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Donation Page
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Virtual Account Number successfully copied!');
    }).catch(err => {
        console.error('Failed to copy:', err);
    });
}

const countDownDate = new Date("{{ $paymentDetails['confirmation_time'] }}").getTime();

const countdownTimer = setInterval(function() {

    const now = new Date().getTime();

    const distance = countDownDate - now;

    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
    document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');

    if (distance < 0) {
        clearInterval(countdownTimer);
        document.getElementById("countdown").innerHTML = "<span class='text-red-600'>Payment time has expired</span>";
        setTimeout(() => {
            window.location.href = "{{ route('donations.index') }}";
        }, 3000);
    }
}, 1000);

setInterval(function() {
    fetch("{{ route('donations.check-status', $donation->id) }}")
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = "{{ route('donations.success', $donation->id) }}";
            } else if (data.status === 'expired') {
                window.location.href = "{{ route('donations.index') }}";
            }
        });
}, 5000);
</script>
@endsection 

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endpush