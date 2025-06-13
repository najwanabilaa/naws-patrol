<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register As Foster Home</title>
    <style>

    body {
        margin: 0 !important;
        padding: 0 !important;
        background: #fff !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        flex-direction: column !important;
        min-height: 100vh !important;
    }

    .container.mx-auto {
        max-width: none !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }

    .relative.bg-gray-900 {
        display: none !important;
    }

    .container {
        text-align: center;
        width: 100%;
        max-width: 400px;
        position: relative;
        z-index: 10;
    }

    h2 {
        color: #FAAF32;
        margin-bottom: 50px;
        font-size: 20px;
    }

    .border-gradient {
        padding: 2px;
        background: linear-gradient(to right, #2B6ED6, #FAAF32);
        border-radius: 20px;
    }

    .form-box {
        background-color: #fff;
        padding: 30px;
        border-radius: 18px;
        width: 100%;
        box-sizing: border-box;
        position: relative;
        z-index: 1;
    }

    input {
        width: 100%;
        margin-bottom: 12px;
        padding: 10px;
        border: none;
        border-bottom: 1px solid #FAAF32;
        outline: none;
        font-size: 14px;
    }

    .slider-button {
        background-color: #2B6ED6;
        color: #fff;
        border: none;
        padding: 10px 16px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        margin: 0 auto;
    }

    .switch {
        display: inline-block;
        width: 24px;
        height: 14px;
        background-color: #fff;
        border-radius: 10px;
        position: relative;
    }

    .switch::before {
        content: "";
        position: absolute;
        width: 10px;
        height: 10px;
        left: 2px;
        top: 2px;
        background-color: #2B6ED6;
        border-radius: 50%;
        transition: 0.3s;
    }

    .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: #ffffff;
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
        z-index: 1000;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .back-button:hover {
        background-color: #f0f0f0;
    }

    .cat-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 0;
    }

    .cat-img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    .remember-me {
        font-size: 14px; 
        font-family: 'Poppins', sans-serif !important; 
        color: #555;
    }

    .error-message {
        color: #ad1100;
        font-size: 12px;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .error-message span {
        display: block;
    }

    input.error {
        border-bottom-color: #ad1100;
    }

    @media (max-width: 480px) {
        .container {
            max-width: 350px;
            padding: 0 20px;
        }
        
        .form-box {
            padding: 20px;
        }
    }

    .error-message, 
    .mt-2 {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .remember-me {
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        color: #555;
        margin-bottom: 15px;
        text-align: left;
    }

    .remember-me label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .remember-me input[type="checkbox"] {
        width: auto;
        margin-right: 8px;
        margin-bottom: 0;
        accent-color: #2B6ED6;
    }

    .link {
        margin-top: 10px;
        font-size: 12px;
    }

    .link:first-of-type {
        margin-top: 15px;
    }

    .link a {
        color: #2B6ED6;
        text-decoration: none;
    }

    .link a:hover {
        text-decoration: underline;
    }

    .form-box > div {
        margin-bottom: 0;
    }

    input:focus {
        border-bottom-color: #2B6ED6;
        box-shadow: 0 1px 0 0 #2B6ED6;
    }

    .slider-button:hover {
        background-color: #1e5bb8;
        transform: translateY(-1px);
        transition: all 0.3s ease;
    }
    </style>
</head>
<body>
    <button class="back-button" onclick="goBack()"> ← </button>

    <div class="container">
        <h2>Register As Foster Home</h2>
        <div class="border-gradient">
            <form method="POST" action="{{ route('fosterHome.register') }}" class="form-box">
                @csrf
                <input type="text" name="name" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="text" name="phone" placeholder="Phone Number" required />
                <button type="submit" class="slider-button">
                    next
                    <span class="switch"></span>
                </button>
            </form>
        </div>
        <div class="cat-container">
            <img src="{{ asset('image/cat1.png') }}" alt="Cats" class="cat-img" />
        </div>
    </div>

    <script>
    function goBack() {
        window.location.href = "{{ route('dashboard') }}";
    }
    </script>
</body>
</html>
