<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
              background: linear-gradient(135deg, #0a1e36 0%, #1a3a5c 50%, #2B5F8C 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
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
        .register-button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .register-button:hover {
            background-color: #218838;
        }
        .login-link {
            margin-top: 20px;
            font-size: 0.9rem;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-icon">
            <!-- Logo Path provided by user -->
            <img src="{{ asset('build/image/2.svg') }}" alt="Logo">
        </div>

        <h2>Create an Account</h2>

        @if(session('success'))
            <div style="color: #28a745; margin-bottom: 10px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="color: #d9534f; margin-bottom: 10px;">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="register-button">
                Register
            </button>
        </form>

        <div class="login-link" style="color: #FFD166;">
            Already have an account? <a href="{{ route('login') }}">Log in</a>
        </div>
    </div>
        <script>
            document.querySelector('form').addEventListener('submit', function (e) {
                const btn = e.target.querySelector('button[type=submit]');
                if (btn) {
                    btn.disabled = true;
                    btn.textContent = 'Processing...';
                }
            });
        </script>
</body>
</html>
