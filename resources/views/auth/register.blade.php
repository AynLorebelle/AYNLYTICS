<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-container {
            background:  linear-gradient(190deg,rgba(65, 105, 225, 0.1) 25%, rgba(232, 244, 77, 0.3));
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 30px;
             border: 5px solid #ffffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
            color: #FFE100;
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
            font-size: 0.8rem;
            margin-top: 5px;
        }
        .register-button {
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

        .register-button:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 15px 40px rgba(232, 244, 77, 0.6),
                0 0 0 2px rgba(232, 244, 77, 0.4);
            background: linear-gradient(135deg, #F4FF7A 0%, #E8F44D 100%);
            color: #000000;
        }
        .login-link {
            color: #000957;
            text-decoration: none;
            font-weight: 500;
            font-size: 1 rem;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .login-link:hover {
            margin-top: 20px;
            color: #FDB813;
            text-decoration: underline;
        }
        
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-icon">
            <!-- Logo Path provided by user -->
            <img src="{{ asset('build/image/2.svg') }}" alt="Logo">
        </div>

        <h2>Create your Account Now !</h2>

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

        <div style="color: #000957; margin-top: 20px;">
            Already have an account? <a class="login-link" href="{{ route('login') }}">Log in</a>
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
