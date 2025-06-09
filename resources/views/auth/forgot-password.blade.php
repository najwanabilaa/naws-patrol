<link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
<x-guest-layout>
<div class="container">
        <h2>Lupa Kata Sandi?</h2>
        <div class="border-gradient">
            <div class="form-box">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Masukkan email Anda untuk menerima tautan reset password.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Kirim Tautan Reset') }}
                        </x-primary-button>
                    </div>
                </form>

                <p class="link mt-4"><a href="{{ route('login') }}">Kembali ke login</a></p>
            </div>
        </div>

        <div class="cat-container">
            <img src="{{ asset('cat.png') }}" alt="Cats" class="cat-img" />
        </div>
    </div>
</x-guest-layout>
