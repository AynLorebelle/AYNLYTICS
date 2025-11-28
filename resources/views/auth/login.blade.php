<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #EFECE3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #000957;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .logo-icon{
            margin-bottom: -40px;
        }
        .logo-icon img {
              position: relative;
                height: 200px;
        }
        h2 {
            margin-bottom: 20px;
            color: #FFD166;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #FFD166;
            font-size: 0.9rem;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
        }
        .form-group .error-message {
            color: #d9534f;
            font-size: 0.8rem;
            margin-top: 5px;
        }
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .form-options .remember-me label {
            display: inline;
            margin-left: 5px;
        }
        .form-options a {
            color: #007bff;
            text-decoration: none;
        }
        .login-button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .login-button:hover {
            background-color: #0056b3;
        }
        .register-link {
            margin-top: 20px;
            font-size: 0.9rem;
        }
        .register-link a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Session Status (Laravel Blade Component) -->
        @if (session('status'))
            <div class="error-message">{{ session('status') }}</div>
        @endif

        <div class="logo-icon">
            <!-- Logo Path provided by user -->
            <img src="{{ asset('build/image/2.svg') }}" alt="Logo">
        </div>

        <h2>Log In to Your Account</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                <!-- Error Messages (Laravel Blade Component) -->
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                <!-- Error Messages (Laravel Blade Component) -->
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-options">
                <div class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me" style="color: #FFD166;">Remember me</label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
            </div>

            <button type="submit" class="login-button">
                Log in
            </button>
        </form>

        @if (Route::has('register'))
        <div class="register-link" style="color: #FFD166;">
            Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
        </div>
        @endif
    </div>
</body>
</html>
