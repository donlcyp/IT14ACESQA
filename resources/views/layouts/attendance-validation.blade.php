<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AJJ CRISBER Engineering Services - Attendance Validation')</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #1e40af;
            --white: #ffffff;
            --gray-500: #667085;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: #dc2626;
            --green-600: #1e40af;
            --black-1: #111827;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: "Inter", sans-serif;
            background-color: var(--main-bg);
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 769px) {
            .main-content { 
                margin-left: 280px; 
            }
        }
        
        @media (max-width: 768px) {
            .main-content { 
                margin-left: 0; 
            }
        }

        .header {
            background: #1e40af;
            padding: 20px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-menu {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
        }

        .header-title {
            color: white;
            font-family: "Zen Dots", sans-serif;
            font-size: 24px;
            font-weight: 400;
            flex: 1;
        }

        .content-area {
            flex: 1;
            overflow-y: auto;
            padding: 30px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Sidebar Styles */
        aside {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            width: 280px;
            height: 100vh;
            padding: 28px 22px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            background-color: #f8fafc;
            border-right: 1px solid #e2e8f0;
            transform: translateX(-100%);
            overflow-y: auto;
        }

        aside.open {
            transform: translateX(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 8px 0 24px rgba(15, 23, 42, 0.08);
        }

        @media (max-width: 768px) {
            .content-area {
                padding: 20px;
            }

            .page-title {
                font-size: 22px;
            }
        }
    </style>
    @yield('extra-styles')
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Header -->
            <header class="header">
                <button class="header-menu" id="headerMenu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <!-- Content Area -->
            <section class="content-area">
                @yield('content')
            </section>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    @include('partials.sidebar-js')
    @yield('scripts')
</body>
</html>
