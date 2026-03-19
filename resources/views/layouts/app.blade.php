<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','AYNYLTICS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')
      <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0a1628;
            color: #ffffff;
            min-height: 100vh;
        }
        
        .header {
            border-bottom: 1px solid #1f2937;
            background-color: #0a1e36;
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 10px 0;
        }
        
        .header-container {
            max-width: 110%;  
            margin: 0;        
            padding: 10px 20px;  
        }
                
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
             width: 100%;
        }
          /* Header actions container */
        .header-actions {
            display: flex;
            align-items: center;
            margin-left: auto;
            padding-right: 20px;  
            
        }

        /* Individual icon buttons */
        .header-icon {
            position: relative;
            padding: 5px;
            color: #ffffffff;
            background: transparent;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 25px;
            
            
        }

        .header-icon:hover {
            box-shadow: 
                0 15px 40px rgba(232, 244, 77, 0.6),
                0 0 0 2px rgba(232, 244, 77, 0.4);
            background: transparent;
        }


        .header-icon .icon {
            width: 24px;
            height: 24px;
        }

        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 100px;
            margin-left: 0px;
            margin-top: 0px;
            padding: 0px;
        }
        
        .logo-icon {
            width: 130px;
            height: 130px;
            background: transparent;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            margin-left: 40px;
        }
        .logo-icon img {
            width: 100%;
            height: auto;
            object-fit: contain;

        }
        
        .logo-text h1 {
            font-size: 20px;
            font-weight: bold;
            color: #d4a574;
            letter-spacing: 0.05em;
        }
        
        .logo-text p {
            font-size: 12px;
            color: #9ca3af;
        }
        

        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            background-color: #ef4444;
            color: white;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 5px;
            border-radius: 10px;
            min-width: 16px;
            text-align: center;
        }
        
        .menu-open {
            position: fixed;           
            right: 20px;                  
            top: 115px;                    
            height: calc(100vh- 84px);             
            width: 250px;              
            border-right: 1px solid #1f2937;  
            background-color: #0a1628;
            padding: 16px 12px;       
            display: flex;
            flex-direction: column;
            align-items: stretch;      
            overflow-y: auto;          
            z-index: 100;   
        }
        
        .menu-nav {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 0;
            gap: 8px;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 8px;
            background-color: transparent;
            color: #9ca3af;
            border: none;
            cursor: pointer;
            font-size: 14px;
            width: 100%;
            text-align: left;
            transition: all 0.2s;
            text-align: left;  
        }
        
        .menu-item:hover { 
             .menu-item:hover {
            box-shadow: 
                0 5px 25px rgba(77, 152, 244, 0.6),
                0 0 0 0px rgba(251, 252, 255, 0.2);
            background: transparent;
        }
        
        }
        
        .menu-item.active {
            background-color: tranparent;
            border: 2px solid #06b6d4;
            boreder-radius: 8px;
            color: white;
        }
        .main-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 32px 24px;
        }
        
        .welcome-section {
            margin-bottom: 32px;
        }
        
        .welcome-section h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
            margin-left: -10px;
            
        }
        
        .welcome-section p {
            color: #9ca3af;
            margin-left: -10px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }
        
        .stat-card {
            background-color: #111827;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #1f2937;
        }
        
        .stat-label {
            color: #9ca3af;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .stat-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: white;
        }
        
        .stat-change {
            font-size: 14px;
            font-weight: 500;
        }
        
        .stat-change.positive {
            color: #10b981;
        }
        
        .stat-change.negative {
            color: #ef4444;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        .content-card {
            background-color: #111827;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #1f2937;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .card-header h3 {
            font-size: 20px;
            font-weight: bold;
        }
        
        .btn-primary {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        
        .transaction-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            background-color: #0a1628;
            border-radius: 8px;
            border: 1px solid #1f2937;
        }
        
        .transaction-name {
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .transaction-date {
            font-size: 14px;
            color: #9ca3af;
        }
        
        .transaction-amount {
            font-weight: bold;
            font-size: 18px;
        }
        
        .transaction-amount.income {
            color: #10b981;
        }
        
        .transaction-amount.expense {
            color: #ef4444;
        }
        
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        
        .action-button {
            background-color: #0a1628;
            border: 2px solid;
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .action-button:hover {
            transform: translateY(-2px);
        }
        
        .action-button span {
            font-size: 14px;
            font-weight: 500;
        }
        
        .icon {
            width: 18px;
            height: 18px;
        }
        
        .hidden {
            display: none;
        }
    </style>
  </head>
  <body>
    
      <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-content">
                <div class="logo-section">
                    <div class="logo-icon"><img src="{{ asset('build/image/2.svg') }}" alt=""></div>
                    <div class="logo-text">
                        <h1> </h1>
                        <p></p>
                    </div>
            
                </div>

                <div class="header-actions">
                     <a href="{{ route('profile.edit') }}" class="menu-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <button class="header-icon" onclick="toggleProfile()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                </path>
            </svg>
        </button>
    </a>

                <a href="{{ route('notifications') }}" class="position-relative">
                <button class="header-icon " onclick="toggleNotifications()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
            <!-- Optional: Notification badge -->
            <span id="notificationBadge" class="notification-badge" style="display: none;">0</span>
        </button>
    </a>

                <button class="header-icon menu " onclick="toggleMenu()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>
            </div>
        </div>

        <div id="menu" class="menu-open hidden">
            <nav class="menu-nav">
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z">
        </path>
    </svg>
    <span>Dashboard</span>
</a>
               

    <!-- Analytics -->
    <a class="nav-link menu-item" 
       href="{{ route('analytics.index') }}" 
       onclick="setActive(1)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
        </svg>
        <span>Analytics</span>
    </a>

    <!-- Budget -->
    <a class="nav-link menu-item" 
       href="{{ route('budgets.index') }}" 
       onclick="setActive(2)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>Budget</span>
    </a>

    <!-- Expenses -->
    <a class="nav-link menu-item" 
       href="{{ route('expenses.index') }}" 
       onclick="setActive(3)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l6 6 4-4 8 8"/>
        </svg>
        <span>Expenses</span>
    </a>

    <!-- Categories -->
    <a class="nav-link menu-item" 
       href="{{ route('categories.index') }}" 
       onclick="setActive(4)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M3 11l8.586 8.586a2 2 0 002.828 0L21 13l-8-8H5a2 2 0 00-2 2v4z"/>
        </svg>
        <span>Categories</span>
    </a>

    <!-- Income -->
    <a class="nav-link menu-item" 
       href="{{ route('incomes.index') }}" 
       onclick="setActive(5)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>Income</span>
    </a>
    
    <a class="nav-link menu-item" href="{{ route('savings.index') }}" onclick="setActive(6)">
    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
    </svg>
    <span>Savings</span>
    </a>

        <a class="nav-link menu-item" href="{{ route('logout') }}" onclick="setActive(6)">
        @csrf
        <svg xmlns="www.w3.org" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h2.5" />
        </svg>
        <span> Logout </span>
    </a>
    
            </nav>
        </div>
    </header>
      
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    @include('partials.alerts')
</div>
      
    <section class="col-md-9">
      @yield('content')
    </section>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>

      document.addEventListener('DOMContentLoaded', (event) => {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl);
        });
        toastList.forEach(toast => toast.show());
    });

    function toggleMenu() {
      const menu = document.getElementById('menu');
      if (!menu) return;
      menu.classList.toggle('hidden');
    }

  document.addEventListener('DOMContentLoaded', function(){
    var offcanvasEl = document.getElementById('offcanvasSidebar');
    if (offcanvasEl) {
      offcanvasEl.querySelectorAll('.nav-link').forEach(function(link){
        link.addEventListener('click', function(){
          var off = bootstrap.Offcanvas.getInstance(offcanvasEl);
          if (off) off.hide();
        });
      });
    }
  });
</script>

   <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        }

        function setActive(index) {
            const items = document.querySelectorAll('.menu-item');
            items.forEach((item, i) => {
                if (i === index) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
            toggleMenu();
        }

        // Auto-refresh notification count every 30 seconds
        async function refreshNotificationCount() {
            try {
                const response = await fetch('/notifications/unread-count');
                const data = await response.json();
                
                const badge = document.getElementById('notificationBadge');
                if (badge) {
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.style.display = 'block';
                    } else {
                        badge.style.display = 'none';
                    }
                }
            } catch (error) {
                console.error('Error fetching unread count:', error);
            }
        }

        // Refresh every 30 seconds
        setInterval(refreshNotificationCount, 30000);

        // Helper functions
        function fmt(amount) {
            if (amount === null || amount === undefined) return '₱0.00';
            return '₱' + Number(amount).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }

        function showLoaded(canvasId) {
            const canvas = document.querySelector(canvasId);
            if (!canvas) return;
            const loader = document.querySelector('.loader[data-target="'+canvasId+'"]');
            if (loader) loader.style.display = 'none';
            canvas.style.display = 'block';
        }
    </script>


@stack('scripts')
<script>
    // Prevent double-submits: disable the submit button and change text when a form is submitted
    document.addEventListener('submit', function (e) {
        try {
            const form = e.target;
            const submit = form.querySelector('button[type=submit], input[type=submit]');
            if (submit) {
                submit.disabled = true;
                if (submit.tagName.toLowerCase() === 'button') {
                    submit.dataset.__orig = submit.innerHTML;
                    submit.innerHTML = 'Processing...';
                }
            }
        } catch (err) {
            console.error(err);
        }
    });
</script>
    <!-- AI Chat Widget -->
<style>
    #ai-chat-bubble {
        position: fixed;
        bottom: 28px;
        right: 28px;
        z-index: 9999;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    #ai-chat-toggle {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(255, 209, 102, 0.4);
        transition: all 0.3s;
        margin-left: auto;
    }

    #ai-chat-toggle:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 28px rgba(255, 209, 102, 0.6);
    }

    #ai-chat-toggle svg {
        width: 26px;
        height: 26px;
         color: #ffffff;  /* was #0a1628 */
    }

    #ai-chat-panel {
        display: none;
        flex-direction: column;
        width: 340px;
        height: 480px;
        background-color: #0a1e36;
        border: 1px solid #1f2937;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(0,0,0,0.5);
        margin-bottom: 12px;
    }

    #ai-chat-header {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    #ai-chat-header span {
        font-weight: 700;
         color: #ffffff;  /* was #0a1628 */
        font-size: 15px;
    }

    #ai-chat-header button {
        background: transparent;
        border: none;
        cursor: pointer;
         color: #ffffff;  /* was #0a1628 */
        font-size: 18px;
        line-height: 1;
    }

    #ai-chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    #ai-chat-messages::-webkit-scrollbar { width: 4px; }
    #ai-chat-messages::-webkit-scrollbar-track { background: transparent; }
    #ai-chat-messages::-webkit-scrollbar-thumb { background: #1f2937; border-radius: 4px; }

    .ai-msg {
        max-width: 85%;
        padding: 10px 14px;
        border-radius: 12px;
        font-size: 13.5px;
        line-height: 1.5;
        white-space: pre-wrap;
    }

    .ai-msg.user {
        background-color: #06b6d4;
        color: #0a1628;
        align-self: flex-end;
        border-bottom-right-radius: 4px;
    }

    .ai-msg.ai {
        background-color: #111827;
        color: #e5e7eb;
        align-self: flex-start;
        border-bottom-left-radius: 4px;
        border: 1px solid #1f2937;
    }

    .ai-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        padding: 0 16px 10px;
    }

    .ai-suggestion-btn {
        background: transparent;
        border: 1px solid #06b6d4;
        color: #06b6d4;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .ai-suggestion-btn:hover {
        background: #06b6d4;
        color: #0a1628;
    }

    #ai-chat-input-area {
        display: flex;
        gap: 8px;
        padding: 12px;
        border-top: 1px solid #1f2937;
    }

    #ai-chat-input {
        flex: 1;
        background-color: #111827;
        border: 1px solid #1f2937;
        border-radius: 8px;
        padding: 8px 12px;
        color: white;
        font-size: 13px;
        outline: none;
        transition: border 0.2s;
    }

    #ai-chat-input:focus {
        border-color: #06b6d4;
    }

    #ai-chat-send {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        border: none;
        border-radius: 8px;
        padding: 8px 14px;
        cursor: pointer;
        color: #0a1628;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.2s;
    }

    #ai-chat-send:hover {
        opacity: 0.9;
    }
</style>

<div id="ai-chat-bubble">
    <div id="ai-chat-panel">
        <div id="ai-chat-header">
            <span>Aynlytics AI</span>
            <button onclick="toggleAIChat()">✕</button>
        </div>
        <div id="ai-chat-messages">
            <div class="ai-msg ai">Hi! I'm your budget assistant. Ask me anything about your finances 💰</div>
        </div>
        <div class="ai-suggestions">
            <button class="ai-suggestion-btn" onclick="askSuggestion(this)">Where am I overspending?</button>
            <button class="ai-suggestion-btn" onclick="askSuggestion(this)">How can I save more?</button>
            <button class="ai-suggestion-btn" onclick="askSuggestion(this)">Am I on budget?</button>
        </div>
        <div id="ai-chat-input-area">
            <input type="text" id="ai-chat-input" placeholder="Ask about your finances..."
                   onkeydown="if(event.key==='Enter') sendAIMessage()">
            <button id="ai-chat-send" onclick="sendAIMessage()">Send</button>
        </div>
    </div>
    <button id="ai-chat-toggle" onclick="toggleAIChat()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3v-3z"/>
        </svg>
    </button>
</div>

<script>
    function toggleAIChat() {
        const panel = document.getElementById('ai-chat-panel');
        panel.style.display = panel.style.display === 'flex' ? 'none' : 'flex';
        if (panel.style.display === 'flex') {
            document.getElementById('ai-chat-input').focus();
        }
    }

    function askSuggestion(btn) {
        document.getElementById('ai-chat-input').value = btn.textContent;
        sendAIMessage();
    }

    async function sendAIMessage() {
        const input = document.getElementById('ai-chat-input');
        const message = input.value.trim();
        if (!message) return;

        appendAIMessage('user', message);
        input.value = '';

        const loading = appendAIMessage('ai', '⏳ Analyzing your data...');

        try {
            const res = await fetch('/ai/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message })
            });

            const data = await res.json();
            loading.remove();
            appendAIMessage('ai', data.reply || 'Sorry, I could not get a response.');
        } catch (err) {
            loading.remove();
            appendAIMessage('ai', '⚠️ Something went wrong. Please try again.');
        }
    }



    function appendAIMessage(role, text) {
        const msgs = document.getElementById('ai-chat-messages');
        const div = document.createElement('div');
        div.className = `ai-msg ${role}`;
        div.textContent = text;
        msgs.appendChild(div);
        msgs.scrollTop = msgs.scrollHeight;
        return div;
    }


</script>
</body>

</html>
