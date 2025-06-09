@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8">
            <!-- Profile Info -->
            <div class="flex items-start space-x-8 mb-8">
                <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Nama</p>
                                <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="text-lg font-semibold">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Telepon</p>
                                <p class="text-lg font-semibold">{{ Auth::user()->phone ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6">Statistik Aktivitas</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Report Submitted -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Laporan Dibuat</p>
                                <p class="text-xl font-bold">{{ Auth::user()->reports()->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Fostered -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Hewan Difoster</p>
                                <p class="text-xl font-bold">{{ Auth::user()->fosters()->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Donations -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Donasi</p>
                                <p class="text-xl font-bold">Rp {{ number_format(Auth::user()->total_donations, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ Auth::user()->successful_donations_count }} donasi berhasil</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Donations -->
            @if(Auth::user()->donations()->count() > 0)
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-4">Riwayat Donasi Terakhir</h3>
                <div class="space-y-4">
                    @foreach(Auth::user()->donations()->latest()->take(5)->get() as $donation)
                    <div class="bg-white rounded-lg border border-gray-200 p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-600">{{ $donation->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <span class="px-2 py-1 text-sm rounded-full 
                                @if($donation->status == 'success') bg-green-100 text-green-800
                                @elseif($donation->status == 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recent Animal Reports -->
            @if(Auth::user()->reports()->count() > 0)
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-4">Riwayat Laporan Hewan Terakhir</h3>
                <div class="space-y-4">
                    @foreach(Auth::user()->reports()->latest()->take(5)->get() as $report)
                    <div class="bg-white rounded-lg border border-gray-200 p-4">
                        <div class="flex justify-between items-start">
                            <div class="flex space-x-4">
                                <div class="w-16 h-16">
                                    <img src="{{ Storage::url($report->foto) }}" alt="Foto hewan" class="w-full h-full object-cover rounded-lg">
                                </div>
                                <div>
                                    <p class="font-medium">{{ $report->nama_lengkap }}</p>
                                    <p class="text-sm text-gray-600">{{ $report->alamat }}</p>
                                    <p class="text-sm text-gray-600">{{ $report->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                            <span class="px-2 py-1 text-sm rounded-full 
                                @if($report->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($report->status === 'in_progress') bg-blue-100 text-blue-800
                                @elseif($report->status === 'completed') bg-green-100 text-green-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                            </span>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('animal-report.show', $report) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Settings and Logout Buttons -->
            <div class="mt-8 flex justify-between">
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Pengaturan
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 