@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/donations/payment_method.css') }}">
@endpush

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8 -mt-16 relative z-10">
    <!-- Payment Details -->
    <div class="payment-details space-y-6">
        <div class="bg-gray-50 p-4 rounded-lg">
            <p class="text-lg font-semibold mb-2">Ringkasan Pembayaran</p>
            <div class="space-y-2">
                <p><span class="text-gray-600">Metode:</span> {{ $paymentMethod === 'bank_transfer' ? 'Transfer Bank' : 'E-Wallet' }}</p>
                <p><span class="text-gray-600">Provider:</span> {{ strtoupper($paymentType) }}</p>
                <p><span class="text-gray-600">Jumlah:</span> Rp {{ number_format($amount, 0, ',', '.') }}</p>
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
                <p class="text-center text-sm text-gray-500 mt-2">Scan QR code menggunakan aplikasi {{ strtoupper($paymentType) }}</p>
            </div>
        </div>
        @else
        <div class="space-y-4">
            <div class="border p-4 rounded-lg">
                <p class="font-semibold mb-2">ID Pembayaran {{ strtoupper($paymentType) }}</p>
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
                <p class="text-center text-sm text-gray-500 mt-2">Scan QR code menggunakan aplikasi {{ strtoupper($paymentType) }}</p>
            </div>
        </div>
        @endif

        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
            <p class="text-yellow-800 font-medium mb-2">Instruksi Pembayaran:</p>
            <ol class="list-decimal list-inside space-y-1 text-sm text-yellow-800">
                @if($paymentType === 'bca')
                <li>Buka aplikasi BCA Mobile</li>
                <li>Pilih m-BCA</li>
                <li>Pilih m-Transfer</li>
                <li>Pilih BCA Virtual Account</li>
                <li>Masukkan nomor Virtual Account</li>
                <li>Periksa detail pembayaran</li>
                <li>Masukkan PIN m-BCA</li>
                <li>Pembayaran selesai</li>
                @elseif($paymentType === 'bni')
                <li>Buka aplikasi BNI Mobile</li>
                <li>Pilih Transfer</li>
                <li>Pilih Virtual Account Billing</li>
                <li>Masukkan nomor Virtual Account</li>
                <li>Konfirmasi detail pembayaran</li>
                <li>Masukkan Password Transaksi</li>
                <li>Pembayaran selesai</li>
                @elseif($paymentType === 'bri')
                <li>Buka aplikasi BRImo</li>
                <li>Pilih Pembayaran</li>
                <li>Pilih BRIVA</li>
                <li>Masukkan nomor Virtual Account</li>
                <li>Periksa detail pembayaran</li>
                <li>Masukkan PIN</li>
                <li>Pembayaran selesai</li>
                @elseif($paymentType === 'gopay')
                <li>Buka aplikasi Gojek</li>
                <li>Pilih Bayar</li>
                <li>Scan QR Code atau masukkan ID Pembayaran</li>
                <li>Periksa detail pembayaran</li>
                <li>Pilih Bayar</li>
                <li>Masukkan PIN GoPay</li>
                <li>Pembayaran selesai</li>
                @elseif($paymentType === 'ovo')
                <li>Buka aplikasi OVO</li>
                <li>Pilih Scan QR</li>
                <li>Scan QR Code atau masukkan ID Pembayaran</li>
                <li>Periksa detail pembayaran</li>
                <li>Pilih Bayar</li>
                <li>Masukkan PIN OVO</li>
                <li>Pembayaran selesai</li>
                @elseif($paymentType === 'dana')
                <li>Buka aplikasi DANA</li>
                <li>Pilih Scan</li>
                <li>Scan QR Code atau masukkan ID Pembayaran</li>
                <li>Periksa detail pembayaran</li>
                <li>Pilih Bayar</li>
                <li>Masukkan PIN DANA</li>
                <li>Pembayaran selesai</li>
                @endif
            </ol>
        </div>

        <div class="text-center">
            <p class="text-sm text-gray-600">Pembayaran akan dikonfirmasi dalam:</p>
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
        alert('Nomor berhasil disalin!');
    }).catch(err => {
        console.error('Gagal menyalin: ', err);
    });
}
</script>
@endpush

@endsection

