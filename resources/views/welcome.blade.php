<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AYNLYTICS - Financial Planner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
           background: linear-gradient(180deg, #001F5B 20%, #002B7A 38%, #578FCA 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        header {
            padding: 20px 40px;
            display: flex;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: -100px;
        }

        .logo-icon {
            margin-left: -50px;
            margin-top: -50px;
            width: 200px;
            height: 200px;
            border-radius: 8px;
        }

        .brand-name {
            color: #FFD166;
            margin-top: -30px;
            margin-left: -50px;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 2px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Main Content Styles */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 20px;
        }

        .content-wrapper {
            max-width: 1000px;
            width: 100%;
            text-align: center;
        }

        /* Logo Card Styles */
        .logo-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 30px 60px;
            margin-bottom: 60px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .logo-image-container {
            display: inline-block;
            margin-bottom: -50px;
            position: relative;
            margin-top: -40px;


        }

        .logo-main {
            max-width: 300px;
            height: 300px;
            position: relative;
            margin-bottom: -70px; 
            
        }

        .brand-title {
            color: #f5f5f5ff;
            font-size: 45px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            letter-spacing: 1px;
            
        }

        .brand-subtitle {
            color: #5A8BB8;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 25px;
            letter-spacing: 2px;
        }

        /* Description Styles */
        .description {
            color: #FFE100;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        /* Button Styles */
        .button-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: -30px;
        }

        .button-link {
            text-decoration: none;
        }

        .btn {
            padding: 16px 48px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            border: none;
        }

        .btn-primary {
           background: transparent;
            color: #ffffffff;
            border: 2px solid #87CEEB;
        }

        .btn-primary:hover {
            color: #FFE100;
            background: rgba(135, 206, 235, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(135, 206, 235, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #ffffffff;
            border: 2px solid #87CEEB;
        }

        .btn-secondary:hover {
            color: #FFE100;
            background: rgba(135, 206, 235, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(135, 206, 235, 0.3);
        }

        /* Features Styles */
        .features-container {
            margin-top: 80px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.08);
            padding: 30px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .feature-icon {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .feature-title {
            color: #ffffffff;
            margin: 0 0 10px 0;
            font-size: 20px;
            font-weight: 600;
        }

        .feature-description {
            color: #B0E0E6;
            margin: 0;
            font-size: 15px;
            line-height: 1.6;
        }

        /* Footer Styles */
        footer {
            padding: 30px 40px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-text {
            color: #87CEEB;
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
            }

            .brand-name {
                font-size: 20px;
            }

            .logo-card {
                padding: 20px 20px;
            }

            .brand-title {
                font-size: 32px;
            }

            .brand-subtitle {
                font-size: 16px;
            }

            .description {
                font-size: 18px;
            }

            .btn {
                padding: 14px 36px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    
    <!-- Header -->
   

    <!-- Main Content -->
    <main>
        <div class="content-wrapper">
            
            <!-- Logo Container -->
            <div class="logo-card">
                <div class="logo-image-container">
                    <img src="{{ asset('build/image/2.svg') }}" alt="AYNLYTICS Financial Planner" class="logo-main">
                </div>
                
                <!-- Brand Title -->
                <h2 class="brand-title">Take Control of Your Financial Future</h2> 
                <p class="description">
                SMART. SIMPLE. SECURE
                </p>
                
            </div>

        
            <!-- Description -->
           

            <!-- Buttons -->
            <div class="button-container">
                <a href="{{ route('register') }}" class="button-link">
                    <button class="btn btn-primary">Get Started</button>
                </a>
                
                <a href="{{ route('login') }}" class="button-link">
                    <button class="btn btn-secondary">Sign In</button>
                </a>
            </div>

            <!-- Features -->
            <div class="features-container">
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3 class="feature-title">Smart Tracking</h3>
                    <p class="feature-description">Monitor your finances with intelligent insights</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3 class="feature-title">Goal Planning</h3>
                    <p class="feature-description">Set and achieve your financial objectives</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3 class="feature-title">Secure & Simple</h3>
                    <p class="feature-description">Your data protected with easy-to-use tools</p>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p class="footer-text">© 2024 AYNLYTICS. All rights reserved.</p>
    </footer>

</body>
</html>

