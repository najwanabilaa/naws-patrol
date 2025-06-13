<link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
<x-guest-layout>
<div class="container">
    <h2>Lupa Kata Sandi?</h2>
    <div class="border-gradient">
        <div class="form-box">
            <div class="form-content">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Masukkan email Anda untuk menerima tautan reset password.') }}
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

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
            </div>
            
            <div class="form-footer">
                <p class="link mt-4"><a href="{{ route('login') }}">Kembali ke login</a></p>
            </div>
        </div>
    </div>
</div>

        <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .border-gradient {
            max-width: 400px;
            min-height: 100px;
            display: flex;
            align-items: center;
            padding: 2px;
            background: linear-gradient(to right, #2B6ED6, #FAAF32);
            border-radius: 20px;
        }

        .form-box {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 18px;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
        }

        .form-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-footer {
            margin-top: auto;
        }
        </style>
        <div class="cat-container">
            <img src="{{ asset('image/cat1.png') }}" alt="Cats" class="cat-img" />
        </div>
    </div>
</x-guest-layout>
