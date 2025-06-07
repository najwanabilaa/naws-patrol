@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold text-center mb-8">Detail Pembayaran</h1>

            <div class="space-y-6">
                <!-- Amount -->
                <div class="text-center">
                    <p class="text-gray-600 mb-1">Jumlah yang Harus Dibayar</p>
                    <p class="text-3xl font-bold text-yellow-600">Rp {{ number_format($paymentDetails['amount'], 0, ',', '.') }}</p>
                </div>

                <!-- Payment Instructions -->
                @if($paymentDetails['payment_type'] === 'bank_transfer')
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="font-semibold text-lg mb-4">Transfer Bank {{ strtoupper($paymentDetails['bank']) }}</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-600 mb-1">Nomor Virtual Account:</p>
                                <div class="flex items-center justify-between bg-white p-3 rounded border">
                                    <span class="font-mono text-lg">{{ $paymentDetails['virtual_account'] }}</span>
                                    <button onclick="copyToClipboard('{{ $paymentDetails['virtual_account'] }}')" 
                                            class="text-yellow-600 hover:text-yellow-700">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <p class="font-medium">Langkah-langkah:</p>
                                <ol class="list-decimal list-inside space-y-1 text-gray-600">
                                    <li>Buka aplikasi m-Banking {{ strtoupper($paymentDetails['bank']) }}</li>
                                    <li>Pilih menu Transfer</li>
                                    <li>Masukkan nomor Virtual Account</li>
                                    <li>Pastikan nominal transfer sudah sesuai</li>
                                    <li>Selesaikan pembayaran</li>
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
                                <p class="mt-2 text-gray-600">Scan QR code menggunakan aplikasi {{ strtoupper($paymentDetails['provider']) }}</p>
                            </div>

                            <div class="space-y-2">
                                <p class="font-medium">Langkah-langkah:</p>
                                <ol class="list-decimal list-inside space-y-1 text-gray-600">
                                    <li>Buka aplikasi {{ strtoupper($paymentDetails['provider']) }}</li>
                                    <li>Pilih menu Scan QR</li>
                                    <li>Scan QR code di atas</li>
                                    <li>Pastikan nominal pembayaran sudah sesuai</li>
                                    <li>Selesaikan pembayaran</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Timer -->
                <div class="text-center">
                    <p class="text-gray-600">Selesaikan pembayaran sebelum:</p>
                    <p class="font-medium text-lg" id="countdown">
                        {{ \Carbon\Carbon::parse($paymentDetails['confirmation_time'])->format('d M Y H:i:s') }}
                    </p>
                    <p class="text-sm text-gray-500 mt-1">Status akan otomatis diperbarui setelah pembayaran diterima</p>
                </div>

                <!-- Transaction ID -->
                <div class="text-center text-sm text-gray-500">
                    ID Transaksi: {{ $paymentDetails['transaction_id'] }}
                </div>

                <!-- Back Button -->
                <div class="text-center mt-8">
                    <a href="{{ route('donations.index') }}" class="text-yellow-600 hover:text-yellow-700">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Halaman Donasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Nomor Virtual Account berhasil disalin!');
    }).catch(err => {
        console.error('Gagal menyalin:', err);
    });
}
</script>
@endsection 