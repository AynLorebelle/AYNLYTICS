<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <style>
        body {
            font-family: Inter, Arial;
            background: linear-gradient(180deg, #001F5B 20%, #002B7A 38%, #578FCA 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .register-container {
            background: linear-gradient(190deg,rgba(65, 105, 225, 0.1) 25%, rgba(232, 244, 77, 0.3));
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
            margin-bottom: 10px;
            color: #FFE100;
        }
        .subtitle {
            color: #E8F44D;
            font-size: 0.9rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        .admin-badge {
            display: inline-block;
            background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #FFE100;
            font-size: 1rem;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 3px solid #EFECE3;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 1rem;
        }
        .form-group input:focus {
            outline: none;
            border-color: #FFE100;
        }
        .form-group .error-message {
            color: #FF6B6B;
            font-size: 0.8rem;
            margin-top: 5px;
            display: block;
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
            margin-top: 10px;
        }
        .register-button:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 15px 40px rgba(232, 244, 77, 0.6),
                0 0 0 2px rgba(232, 244, 77, 0.4);
            background: linear-gradient(135deg, #F4FF7A 0%, #E8F44D 100%);
            color: #000000;
        }
        .register-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        .login-link {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #000957;
        }
        .login-link a {
            color: #E8F44D;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .login-link a:hover {
            color: #FDB813;
            text-decoration: underline;
        }
        .success-message {
            color: #28a745;
            background: rgba(40, 167, 69, 0.1);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        .warning-box {
            background: rgba(255, 107, 107, 0.1);
            border: 2px solid #FF6B6B;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            color: #FFE100;
            font-size: 0.85rem;
            line-height: 1.5;
        }
        .warning-box strong {
            color: #FF6B6B;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Session Messages -->
        @if (session('status'))
            <div class="success-message">{{ session('status') }}</div>
        @endif
        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <div class="logo-icon">
            <img src="{{ asset('build/image/2.svg') }}" alt="Logo">
        </div>

        <span class="admin-badge">🔐 Admin Access</span>
        
        <h2>Admin Registration</h2>
        <p class="subtitle">Create an administrator account</p>

        <div class="warning-box">
            <strong>⚠️ Security Notice:</strong><br>
            This page should only be used to create initial admin accounts. Disable this route after registration.
        </div>

        <form method="POST" action="{{ route('admin.register.store') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="register-button">
                Create Admin Account
            </button>
        </form>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Log In</a>
        </div>

        <script>
            document.querySelector('form').addEventListener('submit', function (e) {
                const btn = e.target.querySelector('button[type=submit]');
                if (btn) {
                    btn.disabled = true;
                    btn.textContent = 'Creating Account...';
                }
            });
        </script>
    </div>
</body>
</html>