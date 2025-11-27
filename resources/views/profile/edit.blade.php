<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - AYNLYTICS Style</title>
    
    <!-- Internal CSS Styles -->
    <style>
        /* A reset for basic consistency */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            background-color: #f4f4f4; /* Light background for the main page content area */
        }

        /* Global style for the main header navigation bar */
        #header-nav {
            background-color: #0d1a2e; /* Deep blue background, matching the image */
            color: #e0e0e0;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Space out logo and navigation */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Styling for the logo text (optional) */
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #d5ad36; /* Gold accent color */
            text-decoration: none;
        }

        /* Container for the user/logout links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px; /* Space between user name and button */
        }

        /* Style for standard links (user name) */
        .nav-links a {
            color: #ccc;
            text-decoration: none;
            font-size: 0.875rem; /* text-sm */
            transition: color 0.15s ease-in-out;
        }

        .nav-links a:hover {
            color: #fff;
        }

        /* Style for the logout button */
        .logout-btn {
            background-color: #1a202c; /* Slightly lighter dark background for contrast */
            color: #d5ad36; /* Gold accent color */
            border: none;
            padding: 10px 15px;
            border-radius: 8px; /* Rounded corners */
            cursor: pointer;
            font-size: 0.875rem;
            transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out;
        }

        .logout-btn:hover {
            background-color: #2d3748;
            color: #e3c05e;
        }

        /* Main content styling (example of where your profile forms would go) */
        .main-content {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <!-- Header/Navigation Section -->
    <header id="header-nav">
        <!-- Link updated to use Laravel's route helper -->
        <a href="{{ route('dashboard') }}" class="logo">AYNLYTICS</a>
        
        <div class="nav-links">
            @auth
            
            <!-- Display authenticated user's name and link to profile edit page -->
            <a href="{{ route('profile.edit') }}">
                {{ Auth::user()->name }}
            </a>

            <!-- Logout Form/Button using Laravel's route helper and CSRF protection -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf 
                <button type="submit" class="logout-btn">
                    Log Out
                </button>
            </form>
            
            @else
                <!-- Optional: Links for guests (if applicable) -->
                <a href="{{ route('login') }}">Log In</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </header>

    <!-- Main Page Content Section -->
    <main class="main-content">
        <h1>Profile Settings</h1>
        <p>Lorem Gayshit</p>
        
        <!-- You would typically use a @yield('content') or @slot('main') here -->

    </main>

</body>
</html>