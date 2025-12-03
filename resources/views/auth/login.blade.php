<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Inter, Arial;
             background: linear-gradient(180deg, #001F5B 20%, #002B7A 38%, #578FCA 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background:  linear-gradient(190deg,rgba(65, 105, 225, 0.1) 25%, rgba(232, 244, 77, 0.3));
            padding: 40px;
            border-radius: 30px;
            border: 5px solid #ffffffff;
            width: 100%;
            max-width: 400px;
            text-align: center;

        }
        .logo-icon{
            margin-bottom: -80px;
            margin-top: -50px;
        }
        .logo-icon img {
              position: relative;
                height: 300px;
        }
        h2 {
            margin-bottom: 20px;
            color: #FFE100;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #FFE100 ;
            font-size: 1 rem;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 3px solid #EFECE3;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 1.2 rem;

        }
        .form-group .error-message {
            color: #d9534f;
            font-size: 0.7 rem;
            margin-top: 10px;
            margin-bottom: -10px;
        }
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 1 rem;
        }
        .form-options .remember-me label {
            display: inline;
            margin-left: 5px;
            color: #000957 ;
        }
        .form-options a {
            color: #000957;
            text-decoration: none;
        }
        .login-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #4A90E2 0%, #5BA3F5 100%);
            color: #ffffffff;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 8px 20px rgba(74, 144, 226, 0.3);
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 15px 40px rgba(232, 244, 77, 0.6),
                0 0 0 2px rgba(232, 244, 77, 0.4);
            background: linear-gradient(135deg, #F4FF7A 0%, #E8F44D 100%);
            color: #000000;
        }


        .register-link {
            margin-top: 20px;
            font-size: 0.8 rem;
        }
        .register-link a {
            color: #000957;
            text-decoration: none;
        }
        .signup-link {
            color: #E8F44D;
            text-decoration: none;
            font-weight: 500;
            font-size: 1 rem;
            transition: all 0.3s ease;
        }

        .signup-link:hover {
            color: #FDB813;
            text-decoration: underline;
        }
        .forgot-password {
            color: #4A90E2;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1 rem;
        }

        .forgot-password:hover {
            color: #FDB813;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Session Status and flashes -->
        @if (session('status'))
            <div class="error-message">{{ session('status') }}</div>
        @endif
        @if (session('success'))
            <div style="color: #28a745; margin-bottom: 10px;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <div class="logo-icon">
            <!-- Logo Path provided by user -->
            <img src="{{ asset('build/image/2.svg') }}" alt="Logo">
        </div>

        <h2>Welcome Back ! </h2>

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
                    <label for="remember_me" style="color: #000957;">Remember me</label>
                </div>

                @if (Route::has('password.request'))
                <div >
                    <a class = "forgot-password "href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                    </div>
                @endif
            </div>

            <button type="submit" class="login-button">
                Log in
            </button>
        </form>

        @if (Route::has('register'))
        <div class="register-link" style="color: #000957;">
            Don't have an account? <a class="signup-link" href="{{ route('register') }}">Sign Up</a>
        </div>
       
        @endif
        <script>
            document.querySelector('form').addEventListener('submit', function (e) {
                const btn = e.target.querySelector('button[type=submit]');
                if (btn) {
                    btn.disabled = true;
                    btn.textContent = 'Processing...';
                }
            });
        </script>
    </div>
</body>
</html>
