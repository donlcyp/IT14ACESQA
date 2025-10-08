<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Quality Assurance</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --gray-500: #667085;
            --white: #ffffff;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --blue-1: #1c57b6;
            --blue-600: #2563eb;
            --red-600: #dc2626;
            --black-1: #313131;
            --sidebar-bg: #c4c4c4;
            --header-bg: #4a5568;
            --main-bg: #e2e8f0;
            --text-lg-medium-font-family: "Inter", sans-serif;
            --text-lg-medium-font-weight: 500;
            --text-lg-medium-font-size: 18px;
            --text-lg-medium-line-height: 28px;
            --text-md-normal-font-family: "Inter", sans-serif;
            --text-md-normal-font-weight: 400;
            --text-md-normal-font-size: 16px;
            --text-md-normal-line-height: 24px;
            --text-sm-medium-font-family: "Inter", sans-serif;
            --text-sm-medium-font-weight: 500;
            --text-sm-medium-font-size: 14px;
            --text-sm-medium-line-height: 20px;
            --text-headline-small-bold-font-family: "Inter", sans-serif;
            --text-headline-small-bold-font-weight: 700;
            --text-headline-small-bold-font-size: 18px;
            --text-headline-small-bold-line-height: 28px;
            --shadow-xs: 0 1px 2px rgba(16, 24, 40, 0.05);
            --shadow-md: 0 6px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: var(--text-md-normal-font-family);
            background-color: var(--main-bg);
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background-color: var(--sidebar-bg);
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid #9ca3af;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo-img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; display:block; }
        .logo-fallback { width:100%; height:100%; border-radius:50%; display:none; align-items:center; justify-content:center; background:#e5e7eb; color:#111827; font-weight:700; font-family: "Inter", sans-serif; }

        .sidebar-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-headline-small-bold-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
            color: black;
        }

        .nav-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .hamburger-menu {
            background: none;
            border: none;
            font-size: 18px;
            color: var(--gray-700);
            cursor: pointer;
        }

        .chevron {
            font-size: 14px;
            color: var(--gray-700);
        }

        .nav-menu {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--gray-700);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .nav-item.active {
            background-color: white;
            color: black;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-icon {
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        .logout-section {
            margin-top: auto;
            padding-top: 20px;
        }

        .logout-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--gray-700);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
            transition: all 0.2s ease;
        }

        .logout-item:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 280px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--header-bg), #2d3748);
            padding: 20px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        .header-menu {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .header-menu:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .header-title {
            color: white;
            font-family: "Zen Dots", sans-serif;
            font-size: 24px;
            font-weight: 400;
            flex: 1;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        /* QA Specific Styles */
        .qa-header {
            background: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            margin-bottom: 30px;
            padding: 20px;
        }

        .qa-content {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .qa-title-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .qa-title-badge {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .qa-title {
            color: #101828;
            font-family: var(--text-lg-medium-font-family);
            font-size: var(--text-lg-medium-font-size);
            font-weight: var(--text-lg-medium-font-weight);
            line-height: var(--text-lg-medium-line-height);
        }

        .qa-badge {
            width: 100px;
            height: 20px;
            background: linear-gradient(90deg, #e0e0e0, #f0f0f0);
            border-radius: 10px;
        }

        .qa-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .qa-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
        }

        .qa-button-base {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            border-radius: 8px;
            background: #fff;
            box-shadow: var(--shadow-xs);
        }

        .qa-search-form {
            width: 100%;
            max-width: 350px;
        }

        .qa-search-input {
            background: var(--white);
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            box-shadow: var(--shadow-xs);
        }

        .qa-search-content {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
        }

        .qa-search-icon {
            font-size: 16px;
            color: #344054;
        }

        .qa-search-field {
            color: var(--gray-500);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
            font-weight: var(--text-md-normal-font-weight);
            line-height: var(--text-md-normal-line-height);
            border: none;
            background: transparent;
            flex: 1;
        }

        .qa-filter-button {
            background: none;
            border: none;
            cursor: pointer;
        }

        .qa-filter-base {
            background: #ffffff;
            border-radius: 8px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: var(--shadow-xs);
        }

        .qa-filter-icon {
            font-size: 16px;
            color: #344054;
        }

        .qa-filter-text {
            color: #344054;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            line-height: var(--text-sm-medium-line-height);
        }

        /* Cards Section */
        .qa-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .qa-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 16px;
            width: 100%;
            max-width: 349px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .qa-card:hover {
            transform: translateY(-4px);
        }

        .qa-card-content {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .qa-card-picture {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .qa-card-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }

        .qa-card-title {
            color: #000000;
            font-family: "Source Code Pro", sans-serif;
            font-size: 18px;
            font-weight: 500;
        }

        .qa-card-details {
            color: #3c3c43;
            font-family: "Source Code Pro", sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.4;
        }

        .qa-card-time {
            color: rgba(102, 102, 102, 0.6);
            font-family: "Source Code Pro", sans-serif;
            font-size: 12px;
            text-align: right;
            margin-bottom: 12px;
        }

        .qa-delete-button {
            background: #ff0000;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .qa-delete-button:hover {
            opacity: 0.9;
        }

        .qa-delete-icon {
            font-size: 16px;
        }

        .qa-delete-text {
            color: #ffffff;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            line-height: var(--text-sm-medium-line-height);
        }

        /* New Button */
        .qa-new-button {
            background: #0084ff;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .qa-new-button:hover {
            opacity: 0.9;
        }

        .qa-new-icon {
            font-size: 16px;
        }

        .qa-new-text {
            color: #ffffff;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            line-height: var(--text-sm-medium-line-height);
        }

        /* Danger button (Delete toggle) */
        .qa-danger-button {
            background: #ff3b30;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .qa-danger-button:hover { opacity: 0.9; }

        /* Card delete hover while in delete mode */
        .qa-card.delete-hover {
            background: #fee2e2;
            border-color: #ef4444;
        }

        /* Delete mode banner */
        .qa-delete-banner {
            display: none;
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 10px 12px;
            margin: 10px 0 20px;
            font-family: var(--text-sm-medium-font-family);
        }
        .qa-delete-banner.active { display: block; }

        /* Modal Styles */
        .qa-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .qa-modal.active {
            display: flex;
            opacity: 1;
        }

        .qa-modal-content {
            background: var(--white);
            border-radius: 8px;
            border: 1px solid var(--gray-400);
            padding: 24px;
            width: 100%;
            max-width: 442px;
            box-shadow: var(--shadow-md);
            position: relative;
        }

        .qa-modal-icon {
            width: 40px;
            height: 40px;
            background: #4a90e2;
            border-radius: 8px;
            position: absolute;
            left: 21px;
            top: 19px;
        }

        .qa-modal-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-headline-small-bold-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
            line-height: var(--text-headline-small-bold-line-height);
            margin: 60px 0 20px;
        }

        .qa-modal-input {
            display: flex;
            flex-direction: column;
            gap: 2px;
            width: 100%;
            margin-bottom: 16px;
        }

        .qa-modal-label {
            color: var(--black-1);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            line-height: var(--text-sm-medium-line-height);
        }

        .qa-modal-field {
            background: var(--white);
            border: 1px solid #c0d5de;
            border-radius: 4px;
            padding: 8px 10px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .qa-modal-field input {
            border: none;
            background: transparent;
            flex: 1;
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-sm-medium-font-size);
            color: #313131;
        }

        .qa-modal-field input::placeholder {
            color: #d9d9d9;
        }

        .qa-modal-field input:focus {
            outline: none;
        }

        .qa-modal-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .qa-modal-button {
            border-radius: 4px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-xs);
            border: 1px solid var(--gray-400);
            background: var(--white);
        }

        .qa-modal-button.primary {
            background: var(--blue-1);
            border: 1px solid var(--blue-1);
        }

        .qa-modal-button-text {
            color: var(--black-1);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            line-height: var(--text-sm-medium-line-height);
        }

        .qa-modal-button.primary .qa-modal-button-text {
            color: var(--white);
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .qa-modal-button:hover {
            opacity: 0.9;
        }

        .qa-error {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .header {
                padding: 15px 20px;
            }

            .header-title {
                font-size: 20px;
            }

            .content-area {
                padding: 20px;
            }

            .qa-cards {
                flex-direction: column;
                align-items: center;
            }

            .qa-card {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="{{ asset('images/aces-logo.png') }}" alt="ACES logo" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="logo-fallback">ACES</div>
                </div>
                <div class="sidebar-title">ACES</div>
            </div>

            <div class="nav-toggle">
                <button class="hamburger-menu" id="navToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="chevron">
                    <i class="fas fa-chevron-right"></i>
                </span>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('dashboard') }}" class="nav-item">
                    <i class="nav-icon fas fa-smile"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('quality-assurance') }}" class="nav-item active">
                    <i class="nav-icon fas fa-bolt"></i>
                    <span>Quality Assurance</span>
                </a>
                <a href="{{ route('audit') }}" class="nav-item">
                    <i class="nav-icon fas fa-gavel"></i>
                    <span>Audit</span>
                </a>
                <a href="{{ route('finance') }}" class="nav-item">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <span>Finance</span>
                </a>
                <a href="{{ route('projects') }}" class="nav-item">
                    <i class="nav-icon fas fa-tasks"></i>
                    <span>Projects</span>
                </a>
                <a href="{{ route('employee-attendance') }}" class="nav-item">
                    <i class="nav-icon fas fa-hard-hat"></i>
                    <span>Employee Attendance</span>
                </a>
            </nav>

            <div class="logout-section">
                <a href="#" class="logout-item">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Header -->
            <header class="header">
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
                <button class="header-menu" id="headerMenu">
                    <i class="fas fa-bars"></i>
                </button>
            </header>

            <!-- Content Area -->
            <section class="content-area">
                <!-- QA Header -->
                <div class="qa-header">
                    <div class="qa-content">
                        <div class="qa-title-section">
                            <div class="qa-title-badge">
                                <h2 class="qa-title">Quality Assurance</h2>
                                <div class="qa-badge"></div>
                            </div>
                        </div>
                        <button class="qa-button" aria-label="Additional options">
                            <div class="qa-button-base">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                        </button>
                        <form action="{{ route('quality-assurance') }}" method="GET" class="qa-search-form">
                            <div class="qa-search-input">
                                <div class="qa-search-content">
                                    <i class="qa-search-icon fas fa-search"></i>
                                    <input class="qa-search-field" name="search" placeholder="Search" type="search"
                                        aria-label="Search quality assurance records" value="{{ request('search') }}" />
                                </div>
                            </div>
                        </form>
                        <button class="qa-filter-button" aria-label="Filter options">
                            <div class="qa-filter-base">
                                <i class="qa-filter-icon fas fa-filter"></i>
                                <span class="qa-filter-text">Filters</span>
                            </div>
                        </button>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div id="qaDeleteBanner" class="qa-delete-banner">
                    Delete mode is ON. Click a project card to confirm deletion.
                </div>

                <!-- QA Cards -->
                <div class="qa-cards" aria-label="Quality assurance records">
                    @forelse($records as $index => $record)
                        <article class="qa-card" data-title="{{ $record->title }}" data-id="{{ $record->id }}" style="cursor: pointer;">
                            <div class="qa-card-content">
                                <div class="qa-card-picture" style="background-color: {{ $record->color }}"></div>
                                <div class="qa-card-info">
                                    <h3 class="qa-card-title">{{ $record->title }}</h3>
                                    <p class="qa-card-details">
                                        Client Name: {{ $record->client }}<br />
                                        Inspected by: {{ $record->inspector }}
                                    </p>
                                </div>
                            </div>
                            <div class="qa-card-time">{{ $record->time }}</div>
                            <form action="{{ route('quality-assurance.destroy', $record->id) }}" method="POST" onclick="event.stopPropagation()" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </article>
                    @empty
                        <div style="color:#6b7280; font-family: var(--text-md-normal-font-family);">No projects yet. Click New to add your first project.</div>
                    @endforelse
                </div>

                <!-- New & Delete Buttons -->
                <div style="display:flex; gap:10px;">
                    <button class="qa-new-button" onclick="document.querySelector('.qa-modal').classList.add('active')"
                        aria-label="Add new record">
                        <i class="qa-new-icon fas fa-plus"></i>
                        <span class="qa-new-text">New</span>
                    </button>
                    @if(($records ?? collect())->count() > 0)
                        <button class="qa-danger-button" id="qaDeleteToggle" aria-label="Toggle delete mode">
                            <i class="fas fa-trash"></i>
                            <span class="qa-new-text">Delete</span>
                        </button>
                    @endif
                </div>

                <!-- Modal -->
                <div class="qa-modal">
                    <div class="qa-modal-content">
                        <div class="qa-modal-icon"></div>
                        <h2 class="qa-modal-title">Add Quality Assurance Record</h2>
                        <form action="{{ route('quality-assurance.store') }}" method="POST">
                            @csrf
                            <div class="qa-modal-input">
                                <label class="qa-modal-label" for="project-name">Project Name</label>
                                <div class="qa-modal-field">
                                    <input type="text" id="project-name" name="title" placeholder="Enter Project Name"
                                        required />
                                </div>
                                @error('title')
                                    <span class="qa-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="qa-modal-input">
                                <label class="qa-modal-label" for="client-name">Client Name</label>
                                <div class="qa-modal-field">
                                    <input type="text" id="client-name" name="client" placeholder="Enter Client Name"
                                        required />
                                </div>
                                @error('client')
                                    <span class="qa-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="qa-modal-input">
                                <label class="qa-modal-label" for="inspector-name">Inspector Name</label>
                                <div class="qa-modal-field">
                                    <input type="text" id="inspector-name" name="inspector"
                                        placeholder="Enter Inspector Name" required />
                                </div>
                                @error('inspector')
                                    <span class="qa-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="qa-modal-input">
                                <label class="qa-modal-label" for="time">Time</label>
                                <div class="qa-modal-field">
                                    <input type="time" id="time" name="time" required />
                                </div>
                                @error('time')
                                    <span class="qa-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="qa-modal-input">
                                <label class="qa-modal-label" for="color">Color</label>
                                <div class="qa-modal-field">
                                    <input type="color" id="color" name="color" value="#520d0d" required />
                                </div>
                                @error('color')
                                    <span class="qa-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="qa-modal-buttons">
                                <button type="button" class="qa-modal-button"
                                    onclick="document.querySelector('.qa-modal').classList.remove('active')">
                                    <span class="qa-modal-button-text">Cancel</span>
                                </button>
                                <button type="submit" class="qa-modal-button primary">
                                    <span class="qa-modal-button-text">Add</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Sidebar toggle functionality
        const headerMenu = document.getElementById('headerMenu');
        const navToggle = document.getElementById('navToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }

        headerMenu.addEventListener('click', toggleSidebar);
        navToggle.addEventListener('click', toggleSidebar);

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function (e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !headerMenu.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('open', 'collapsed');
                mainContent.classList.remove('expanded');
            }
        });

        // Modal functionality
        document.querySelector('.qa-modal').addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });

        // Delete mode for cards
        let deleteMode = false;
        const deleteToggle = document.getElementById('qaDeleteToggle');
        const cards = document.querySelectorAll('.qa-card');

        function updateCardInteractions() {
            cards.forEach(card => {
                if (deleteMode) {
                    // disable navigation while in delete mode
                    card.onclick = function (e) { e.preventDefault(); };
                    card.addEventListener('mouseenter', onCardEnter);
                    card.addEventListener('mouseleave', onCardLeave);
                    card.addEventListener('click', onCardDeleteClick);
                } else {
                    card.removeEventListener('mouseenter', onCardEnter);
                    card.removeEventListener('mouseleave', onCardLeave);
                    card.removeEventListener('click', onCardDeleteClick);
                    card.classList.remove('delete-hover');
                    // default click goes to details
                    card.onclick = function () { window.location = `{{ url('/quality-assurance') }}` + '/' + card.dataset.id; };
                }
            });
        }

        function onCardEnter(e) { e.currentTarget.classList.add('delete-hover'); }
        function onCardLeave(e) { e.currentTarget.classList.remove('delete-hover'); }
        function onCardDeleteClick(e) {
            const card = e.currentTarget;
            const title = card.dataset.title;
            const ok = confirm(`Are you sure to delete ${title}?`);
            if (ok) {
                const form = card.querySelector('form');
                if (form) {
                    // Submit the form and keep user on the same page
                    form.submit();
                }
            }
            e.preventDefault();
            e.stopPropagation();
        }

        deleteToggle && deleteToggle.addEventListener('click', function () {
            deleteMode = !deleteMode;
            this.style.opacity = deleteMode ? '0.9' : '1';
            const banner = document.getElementById('qaDeleteBanner');
            if (banner) banner.classList.toggle('active', deleteMode);
            updateCardInteractions();
        });

        // Initialize default click to show
        updateCardInteractions();
    </script>
</body>

</html>