<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Naw's Patrol Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h2>Naw's Patrol Login</h2>
        <div class="border-gradient">
            <div class="form-box">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="Email" 
                           required 
                           autofocus 
                           autocomplete="username" />
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <input id="password" 
                           type="password" 
                           name="password" 
                           placeholder="Password" 
                           required 
                           autocomplete="current-password" />
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <div class="remember-me">
                        <label for="remember_me">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="slider-button">
                        Login <span class="switch"></span>
                    </button>
                    
                    @if (Route::has('password.request'))
                        <div class="link">
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                        </div>
                    @endif
                    
                    <div class="link">
                        Don't Have an Account? <a href="{{ route('register') }}">Sign Up.</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="cat-container">
        <img src="{{ asset('image/cat.png') }}" alt="Cats" class="cat-img" />
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>