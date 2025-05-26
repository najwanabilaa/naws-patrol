<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Naw's Patrol Register</title>
    @vite(['resources/css/login-register.css'])
    @vite(['resources/js/login-register.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Naw's Patrol Register</h2>
        <div class="border-gradient">
            <div class="form-box">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                
                    <div>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               placeholder="Name"
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               autocomplete="name" />
                        @if($errors->get('name'))
                            <div class="error-message">
                                @foreach($errors->get('name') as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Email Address -->
                    <div>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               placeholder="Email"
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="username" />
                        @if($errors->get('email'))
                            <div class="error-message">
                                @foreach($errors->get('email') as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div>
                        <input id="password" 
                               type="password"
                               name="password"
                               placeholder="Password"
                               required 
                               autocomplete="new-password" />
                        @if($errors->get('password'))
                            <div class="error-message">
                                @foreach($errors->get('password') as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <input id="password_confirmation" 
                               type="password"
                               name="password_confirmation" 
                               placeholder="Confirm Password"
                               required 
                               autocomplete="new-password" />
                        @if($errors->get('password_confirmation'))
                            <div class="error-message">
                                @foreach($errors->get('password_confirmation') as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <input id="phone" 
                               type="text"
                               name="phone"
                               placeholder="Phone Number"
                               value="{{ old('phone') }}"
                               required 
                               autocomplete="tel" />
                        @if($errors->get('phone'))
                            <div class="error-message">
                                @foreach($errors->get('phone') as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="slider-button">
                        Join Us <span class="switch"></span>
                    </button>
                    
                    <div class="link">
                        <a href="{{ route('login') }}">Already registered?</a>
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