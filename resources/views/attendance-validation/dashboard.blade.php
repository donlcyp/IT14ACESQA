<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AJJ CRISBER Engineering Services - Attendance Validation Dashboard</title>
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
            --green-600: #047857;
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
            background: linear-gradient(135deg, var(--header-bg), #1e40af);
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
            padding: 16px;
        }

        .page-header {
            margin-bottom: 12px;
        }

        .page-title {
            font-size: 20px;
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
<div style="padding: 12px 16px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; margin-bottom: 16px; border-radius: 8px;">
    <h1 style="margin: 0 0 4px 0; font-size: 20px; font-weight: 700;">Validation Dashboard</h1>
    <p style="margin: 0; font-size: 13px; opacity: 0.9;">Real-time attendance validation statistics</p>
</div>

<!-- Statistics Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px; margin-bottom: 16px;">
    <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #ef4444; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 6px;">TODAY PENDING</div>
        <div style="font-size: 24px; font-weight: 700; color: #ef4444;">{{ $stats['pending_today'] }}</div>
        <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">Waiting for approval</div>
    </div>

    <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #3b82f6; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 6px;">TOTAL PENDING</div>
        <div style="font-size: 24px; font-weight: 700; color: #3b82f6;">{{ $stats['pending_total'] }}</div>
        <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">All pending validations</div>
    </div>

    <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #0369a1; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 6px;">TODAY APPROVED</div>
        <div style="font-size: 24px; font-weight: 700; color: #0369a1;">{{ $stats['approved_today'] }}</div>
        <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">Approved so far</div>
    </div>

    <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #8b5cf6; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 6px;">MONTH APPROVED</div>
        <div style="font-size: 24px; font-weight: 700; color: #8b5cf6;">{{ $stats['approved_month'] }}</div>
        <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">This month</div>
    </div>

    <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #f59e0b; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 6px;">MONTH REJECTED</div>
        <div style="font-size: 24px; font-weight: 700; color: #f59e0b;">{{ $stats['rejected_month'] }}</div>
        <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">This month</div>
    </div>

    <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #14b8a6; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 6px;">TOTAL VALIDATED</div>
        <div style="font-size: 24px; font-weight: 700; color: #14b8a6;">{{ $stats['total_validated'] }}</div>
        <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">All time</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
    <!-- Pending Today -->
    <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="padding: 10px 12px; border-bottom: 1px solid #e5e7eb;">
            <h3 style="margin: 0; color: #991b1b; font-size: 13px; font-weight: 700;">
                <i class="fas fa-clock"></i> Pending Today ({{ $pendingToday->count() }})
            </h3>
        </div>
        @if($pendingToday->count() > 0)
            <div style="max-height: 250px; overflow-y: auto;">
                @foreach($pendingToday as $record)
                    <div style="padding: 10px 12px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; gap: 8px;">
                        <div>
                            <div style="font-weight: 600; color: #1f2937; font-size: 13px;">{{ $record->f_name }} {{ $record->l_name }}</div>
                            <div style="font-size: 11px; color: #6b7280; margin-top: 2px;">{{ $record->punch_in_time ? $record->punch_in_time->format('H:i:s') : 'N/A' }}</div>
                        </div>
                        <div style="text-align: right; flex-shrink: 0;">
                            @if($record->is_late)
                                <span style="display: inline-block; color: #991b1b; font-size: 10px; font-weight: 600;">LATE</span>
                            @else
                                <span style="display: inline-block; color: #166534; font-size: 10px; font-weight: 600;">ON TIME</span>
                            @endif
                            <div style="margin-top: 4px;">
                                <a href="{{ route('attendance-validation.show', $record->id) }}" style="display: inline-block; padding: 3px 8px; background: #3b82f6; color: white; text-decoration: none; border-radius: 3px; font-size: 10px; font-weight: 600;">Review</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="padding: 20px; text-align: center; color: #6b7280; font-size: 13px;">
                <i class="fas fa-check-circle" style="font-size: 24px; color: #0369a1; margin-bottom: 6px; display: block;"></i>
                <p>No pending records for today</p>
            </div>
        @endif
    </div>

    <!-- Late Pending Approval -->
    <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="padding: 10px 12px; border-bottom: 1px solid #e5e7eb;">
            <h3 style="margin: 0; color: #92400e; font-size: 13px; font-weight: 700;">
                <i class="fas fa-exclamation-triangle"></i> Late Punch-Ins ({{ $latePendingApproval->count() }})
            </h3>
        </div>
        @if($latePendingApproval->count() > 0)
            <div style="max-height: 250px; overflow-y: auto;">
                @foreach($latePendingApproval as $record)
                    <div style="padding: 10px 12px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; gap: 8px;">
                        <div>
                            <div style="font-weight: 600; color: #1f2937; font-size: 13px;">{{ $record->f_name }} {{ $record->l_name }}</div>
                            <div style="font-size: 11px; color: #6b7280; margin-top: 2px;">
                                {{ $record->date->format('Y-m-d') }} - {{ $record->punch_in_time ? $record->punch_in_time->format('H:i:s') : 'N/A' }}
                            </div>
                            <div style="font-size: 11px; color: #991b1b; font-weight: 600; margin-top: 2px;">
                                <i class="fas fa-clock"></i> {{ $record->late_minutes }} min late
                            </div>
                        </div>
                        <div style="text-align: right; flex-shrink: 0;">
                            <a href="{{ route('attendance-validation.show', $record->id) }}" style="display: inline-block; padding: 4px 10px; background: #ef4444; color: white; text-decoration: none; border-radius: 3px; font-size: 10px; font-weight: 600;">Review</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="padding: 20px; text-align: center; color: #6b7280; font-size: 13px;">
                <i class="fas fa-smile" style="font-size: 24px; color: #0369a1; margin-bottom: 6px; display: block;"></i>
                <p>No late punch-ins pending approval</p>
            </div>
        @endif
    </div>
</div>

<!-- Quick Action Links -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 10px; margin-top: 12px;">
    <a href="{{ route('attendance-validation.index') }}" style="background: white; padding: 10px 12px; border-radius: 8px; text-decoration: none; border-left: 3px solid #ef4444; box-shadow: 0 1px 2px rgba(0,0,0,0.08); transition: all 0.3s;">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600;">PENDING</div>
        <div style="font-size: 16px; font-weight: 700; color: #ef4444; margin-top: 3px;">Review All</div>
    </a>

    <a href="{{ route('attendance-validation.approved') }}" style="background: white; padding: 10px 12px; border-radius: 8px; text-decoration: none; border-left: 3px solid #0369a1; box-shadow: 0 1px 2px rgba(0,0,0,0.08); transition: all 0.3s;">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600;">APPROVED</div>
        <div style="font-size: 16px; font-weight: 700; color: #0369a1; margin-top: 3px;">{{ $stats['approved_month'] }} This Month</div>
    </a>

    <a href="{{ route('attendance-validation.rejected') }}" style="background: white; padding: 10px 12px; border-radius: 8px; text-decoration: none; border-left: 3px solid #f59e0b; box-shadow: 0 1px 2px rgba(0,0,0,0.08); transition: all 0.3s;">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600;">REJECTED</div>
        <div style="font-size: 16px; font-weight: 700; color: #f59e0b; margin-top: 3px;">{{ $stats['rejected_month'] }} This Month</div>
    </a>
</div>
            </section>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    @include('partials.sidebar-js')
</body>
</html>
