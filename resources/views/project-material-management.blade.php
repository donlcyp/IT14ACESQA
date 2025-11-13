<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Project Material Management</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #16a34a;
            --white: #ffffff;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;

            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-500: #667085;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --black-1: #111827;

            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: var(--accent);
            --green-600: #059669;

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
            color: var(--gray-700);
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease;
        }
        .main-content.sidebar-closed {
            margin-left: 0;
        }
        @media (min-width: 769px) {
            .main-content {
                margin-left: 280px;
            }
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0 !important;
            }
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--header-bg), #16a34a);
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

        /* List Section */
        .qa-list-container {
            width: 100%;
            margin-bottom: 30px;
        }

        .qa-list {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .qa-list-header {
            background: #f5f5f5;
            border-bottom: 1px solid #e0e0e0;
            display: grid;
            grid-template-columns: 40px 1fr 150px 150px 150px 100px;
            gap: 16px;
            padding: 16px 20px;
            align-items: center;
            font-weight: 600;
            color: #374151;
            font-family: "Source Code Pro", sans-serif;
            font-size: 14px;
        }

        .qa-list-row {
            display: grid;
            grid-template-columns: 40px 1fr 150px 150px 150px 100px;
            gap: 16px;
            padding: 16px 20px;
            align-items: center;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s ease;
            cursor: pointer;
        }

        .qa-list-row:last-child {
            border-bottom: none;
        }

        .qa-list-row:hover {
            background-color: #f9f9f9;
        }

        .qa-list-row.delete-hover {
            background-color: #fee2e2;
        }

        .qa-color-indicator {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .qa-list-cell {
            color: #3c3c43;
            font-family: "Source Code Pro", sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .qa-list-cell.title {
            font-weight: 600;
            color: #000000;
        }

        .qa-list-cell.time {
            color: rgba(102, 102, 102, 0.8);
            font-size: 12px;
        }

        .qa-view-button {
            background: var(--accent);
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: white;
            cursor: pointer;
            transition: opacity 0.2s ease;
            font-family: "Source Code Pro", sans-serif;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
        }

        .qa-view-button:hover {
            opacity: 0.85;
        }

        .qa-view-button i {
            font-size: 14px;
        }

        .qa-delete-button {
            background: var(--accent);
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
            background: var(--accent);
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
            background: var(--accent);
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .qa-danger-button:hover { background: #15803d; }

        /* Card delete hover while in delete mode */
        .qa-card.delete-hover {
            background: #fee2e2;
            border-color: #ef4444;
        }

        /* Buttons Container */
        .qa-buttons-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
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

        /* Pagination Bar */
        /* Modern Pagination Styles */
        .pagination-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            padding: 24px 0;
            user-select: none;
        }
        .pagination-info {
            color: #6b7280;
            font-size: 14px;
            text-align: center;
        }
        .pagination-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .pagination-nav {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }
        .page-btn:hover:not(.disabled):not(.active):not(.ellipsis) {
            background: #f3f4f6;
            color: #111827;
        }
        .page-btn:active:not(.disabled):not(.ellipsis) {
            transform: scale(0.95);
        }
        .page-btn.active {
            background: var(--accent);
            color: #ffffff;
            font-weight: 600;
        }
        .page-btn.disabled {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }
        .page-btn.arrow {
            font-size: 20px;
            font-weight: 400;
        }
        .page-btn.ellipsis {
            cursor: default;
            pointer-events: none;
        }
        .page-btn.ellipsis:hover {
            background: transparent;
        }
        @media (max-width: 640px) {
            .page-btn {
                min-width: 32px;
                height: 32px;
                font-size: 13px;
            }
            .page-btn.arrow {
                font-size: 18px;
            }
        }

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
            background: var(--accent);
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

        .qa-modal-field select {
            border: none;
            background: transparent;
            flex: 1;
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-sm-medium-font-size);
            color: #313131;
        }

        .qa-modal-field select:focus {
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
        @media (max-width: 1200px) {
            .qa-list-header,
            .qa-list-row {
                grid-template-columns: 40px 1fr 100px 100px 100px;
                gap: 12px;
            }
        }

        @media (max-width: 992px) {
            .qa-list-header,
            .qa-list-row {
                grid-template-columns: 40px 1fr 80px 80px;
                gap: 10px;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .header-title {
                font-size: 20px;
            }

            .content-area {
                padding: 20px;
            }

            .qa-list-header,
            .qa-list-row {
                grid-template-columns: 30px 1fr;
                gap: 8px;
            }

            .qa-list-header > div:not(:first-child),
            .qa-list-row > div:nth-child(n+3) {
                display: none;
            }

            .qa-list-cell {
                font-size: 13px;
            }

            .qa-buttons-container {
                gap: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
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
                <!-- QA Header -->
                <div class="qa-header">
                    <div class="qa-content">
                        <div class="qa-title-section">
                            <div class="qa-title-badge">
                                <h2 class="qa-title">Project Material Management</h2>
                            </div>
                        </div>
                        <button class="qa-button" aria-label="Additional options">
                            <div class="qa-button-base">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                        </button>
                        <form class="qa-search-form">
                            <div class="qa-search-input">
                                <div class="qa-search-content">
                                    <i class="qa-search-icon fas fa-search"></i>
                                    <input class="qa-search-field" name="search" placeholder="Search" type="search"
                                        aria-label="Search quality assurance records" />
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

                <!-- Actions -->
                <div class="qa-buttons-container">
                    <button class="qa-danger-button" id="qaDeleteToggle" aria-label="Toggle delete mode">
                        <i class="fas fa-trash"></i>
                        <span class="qa-new-text">Delete</span>
                    </button>
                </div>

                <div id="qaDeleteBanner" class="qa-delete-banner">
                    Delete mode is ON. Click a row to confirm deletion.
                </div>

                <!-- QA List View -->
                <div class="qa-list-container" aria-label="Quality assurance records">
                    <div class="qa-list">
                        <div class="qa-list-header">
                            <div></div>
                            <div>Project Name</div>
                            <div>Client Name</div>
                            <div>Inspector</div>
                            <div>Time</div>
                            <div></div>
                        </div>
                        
                        @forelse($records as $record)
                        <div class="qa-list-row" data-title="{{ $record->title }}" data-id="{{ $record->id }}">
                            <div class="qa-color-indicator" data-color="{{ $record->color ?? '#520d0d' }}"></div>
                            <div class="qa-list-cell title">{{ $record->title }}</div>
                            <div class="qa-list-cell">{{ $record->client }}</div>
                            <div class="qa-list-cell">{{ $record->inspector }}</div>
                            <div class="qa-list-cell time">{{ $record->time }}</div>
                            <div style="display: flex; justify-content: center;">
                                <button type="button" class="qa-view-button" data-view-id="{{ $record->id }}" aria-label="View project details">
                                    <i class="fas fa-eye"></i>
                                    <span>View</span>
                                </button>
                            </div>
                            <form action="{{ route('project-material-management.destroy', $record->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                        @empty
                        <div style="color:#6b7280; font-family: var(--text-md-normal-font-family); padding: 20px;">No project records yet. Create a project from the Projects page to get started.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Pagination -->
                @if($records instanceof \Illuminate\Pagination\LengthAwarePaginator && $records->hasPages())
                    @php
                        $currentPage = $records->currentPage();
                        $lastPage = $records->lastPage();
                        $pageNumbers = [];

                        if ($lastPage <= 7) {
                            for ($i = 1; $i <= $lastPage; $i++) {
                                $pageNumbers[] = $i;
                            }
                        } else {
                            $pageNumbers[] = 1;
                            if ($currentPage > 3) {
                                $pageNumbers[] = '...';
                            }
                            $start = max(2, $currentPage - 1);
                            $end = min($lastPage - 1, $currentPage + 1);
                            for ($i = $start; $i <= $end; $i++) {
                                $pageNumbers[] = $i;
                            }
                            if ($currentPage < $lastPage - 2) {
                                $pageNumbers[] = '...';
                            }
                            $pageNumbers[] = $lastPage;
                        }
                    @endphp
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Showing {{ $records->firstItem() }} to {{ $records->lastItem() }}
                            of {{ $records->total() }} results
                        </div>
                        <div class="pagination-controls">
                            @if ($records->onFirstPage())
                                <span class="page-btn arrow disabled">‹</span>
                            @else
                                <a class="page-btn arrow" href="{{ $records->previousPageUrl() }}" rel="prev">‹</a>
                            @endif

                            <div class="pagination-nav">
                                @foreach ($pageNumbers as $page)
                                    @if ($page === '...')
                                        <span class="page-btn ellipsis">…</span>
                                    @elseif ($page == $currentPage)
                                        <span class="page-btn active">{{ $page }}</span>
                                    @else
                                        <a class="page-btn" href="{{ $records->url($page) }}">{{ $page }}</a>
                                    @endif
                                @endforeach
                            </div>

                            @if ($records->hasMorePages())
                                <a class="page-btn arrow" href="{{ $records->nextPageUrl() }}" rel="next">›</a>
                            @else
                                <span class="page-btn arrow disabled">›</span>
                            @endif
                        </div>
                    </div>
                @endif

            </section>
        </main>
    </div>

    @include('partials.sidebar-js')

    <script>
        // Set background colors for qa-color-indicator elements
        document.querySelectorAll('.qa-color-indicator').forEach(element => {
            const color = element.getAttribute('data-color');
            if (color) {
                element.style.backgroundColor = color;
            }
        });

        // Delete mode for rows
        let deleteMode = false;
        const deleteToggle = document.getElementById('qaDeleteToggle');
        const rows = document.querySelectorAll('.qa-list-row');

        function updateRowInteractions() {
            rows.forEach(row => {
                if (deleteMode) {
                    // disable navigation while in delete mode
                    row.onclick = function (e) { e.preventDefault(); };
                    row.addEventListener('mouseenter', onRowEnter);
                    row.addEventListener('mouseleave', onRowLeave);
                    row.addEventListener('click', onRowDeleteClick);
                } else {
                    row.removeEventListener('mouseenter', onRowEnter);
                    row.removeEventListener('mouseleave', onRowLeave);
                    row.removeEventListener('click', onRowDeleteClick);
                    row.classList.remove('delete-hover');
                    // default click goes to details
                    row.onclick = function () { 
                        window.location = showRoute.replace(':id', row.dataset.id);
                    };
                }
            });
        }

        function onRowEnter(e) { e.currentTarget.classList.add('delete-hover'); }
        function onRowLeave(e) { e.currentTarget.classList.remove('delete-hover'); }
        function onRowDeleteClick(e) {
            const row = e.currentTarget;
            const title = row.dataset.title;
            const ok = confirm(`Are you sure to delete ${title}?`);
            if (ok) {
                const form = row.querySelector('form');
                if (form) {
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
            updateRowInteractions();
        });

        // Initialize default click to show
        updateRowInteractions();

        // Define the show route for navigation
        const showRoute = '{{ route("project-material-management-show", ":id") }}';

        // Handle view button clicks
        document.querySelectorAll('.qa-view-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const recordId = this.getAttribute('data-view-id');
                window.location = showRoute.replace(':id', recordId);
            });
        });
    </script>
</body>

</html>