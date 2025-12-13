<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AJJ CRISBER Engineering Services - Salary Settings</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
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
            --text-md-normal-font-family: "Inter", sans-serif;
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

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 769px) {
            .main-content { margin-left: 280px; }
            .main-content.sidebar-closed { margin-left: 0; }
        }

        @media (max-width: 768px) {
            .main-content { margin-left: 0; }
        }

        .content-area {
            flex: 1;
            padding: 20px;
            padding-top: 20px;
            background: #f9fafb;
        }

        .page-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: var(--shadow-md);
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--gray-600);
        }

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #dbeafe;
            color: #1e3a8a;
            border: 1px solid #bfdbfe;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .rates-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .rate-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid #e5e7eb;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .rate-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .rate-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .position-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--black-1);
        }

        .position-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .position-icon.pm { color: #1d4ed8; }
        .position-icon.supervisor { color: #b45309; }
        .position-icon.finance { color: #166534; }
        .position-icon.qa { color: #7c3aed; }
        .position-icon.hr { color: #be185d; }
        .position-icon.worker { color: #4338ca; }
        .position-icon.default { color: #6b7280; }

        .rate-card-body {
            margin-bottom: 16px;
        }

        .current-rate {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 8px;
        }

        .rate-amount {
            font-size: 28px;
            font-weight: 700;
            color: var(--accent);
        }

        .rate-label {
            font-size: 14px;
            color: var(--gray-600);
        }

        .hourly-rate {
            font-size: 13px;
            color: var(--gray-500);
            background: #f0fdf4;
            padding: 6px 10px;
            border-radius: 6px;
            display: inline-block;
        }

        .rate-description {
            font-size: 13px;
            color: var(--gray-600);
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }

        .rate-form {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 60px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background: #1e3a8a;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: var(--gray-700);
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .btn-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-danger:hover {
            background: #fecaca;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .btn-block {
            width: 100%;
        }

        .form-actions {
            display: flex;
            gap: 10px;
        }

        .add-position-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
        }

        .add-position-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .add-position-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--black-1);
        }

        .add-position-form {
            display: grid;
            grid-template-columns: 1fr 1fr 2fr auto;
            gap: 16px;
            align-items: end;
        }

        @media (max-width: 900px) {
            .add-position-form {
                grid-template-columns: 1fr;
            }
        }

        .updated-info {
            font-size: 11px;
            color: var(--gray-500);
            margin-top: 8px;
        }

        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .info-box h4 {
            font-size: 14px;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box p {
            font-size: 13px;
            color: #1e40af;
            line-height: 1.5;
        }

        .delete-form {
            display: inline;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <div class="main-content" id="mainContent">
            <!-- Header -->
            <header class="header" style="background: linear-gradient(135deg, var(--accent), #1e40af); padding: 20px 30px; display: flex; align-items: center; gap: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <button class="header-menu" id="headerMenu" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer; padding: 8px; border-radius: 4px;">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 style="color: white; font-family: 'Zen Dots', sans-serif; font-size: 24px; font-weight: 400; flex: 1;">AJJ CRISBER Engineering Services</h1>
            </header>

            <div class="content-area">
                <div class="page-header">
                    <h1 class="page-title"><i class="fas fa-peso-sign" style="margin-right: 10px; color: var(--accent);"></i>Salary Rate Settings</h1>
                    <p class="page-subtitle">Manage daily rates for each position. Changes will affect labor cost calculations for all projects.</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="info-box">
                    <h4><i class="fas fa-info-circle"></i> How Labor Cost is Calculated</h4>
                    <p>
                        Labor cost is calculated based on <strong>actual hours worked</strong>, not a fixed daily rate.<br>
                        <strong>Hourly Rate</strong> = Daily Rate ÷ 8 hours (standard work day)<br>
                        <strong>Labor Cost</strong> = Hourly Rate × Actual Hours Worked<br><br>
                        Example: If a Project Manager (₱3,000/day) works 7 hours instead of 8, they earn ₱375/hr × 7 = <strong>₱2,625</strong>
                    </p>
                </div>

                <!-- Add New Position -->
                <div class="add-position-card">
                    <div class="add-position-header">
                        <i class="fas fa-plus-circle" style="color: var(--accent); font-size: 20px;"></i>
                        <h3>Add New Position</h3>
                    </div>
                    <form action="{{ route('settings.salary-rates.store') }}" method="POST" class="add-position-form">
                        @csrf
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="new_position">Position Name</label>
                            <input type="text" id="new_position" name="position" placeholder="e.g., Senior Engineer" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="new_daily_rate">Daily Rate (₱)</label>
                            <input type="number" id="new_daily_rate" name="daily_rate" step="0.01" min="0" placeholder="1000.00" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="new_description">Description (Optional)</label>
                            <input type="text" id="new_description" name="description" placeholder="Brief description of the role">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Position
                        </button>
                    </form>
                </div>

                <!-- Existing Rates -->
                <div class="rates-container">
                    @foreach ($rates as $rate)
                        @php
                            $iconClass = match($rate->position) {
                                'Project Manager' => 'pm',
                                'Site Supervisor' => 'supervisor',
                                'Finance Manager' => 'finance',
                                'Quality Assurance Officer' => 'qa',
                                'HR/Timekeeper' => 'hr',
                                'Construction Worker' => 'worker',
                                default => 'default'
                            };
                            $icon = match($rate->position) {
                                'Project Manager' => 'fa-user-tie',
                                'Site Supervisor' => 'fa-hard-hat',
                                'Finance Manager' => 'fa-calculator',
                                'Quality Assurance Officer' => 'fa-clipboard-check',
                                'HR/Timekeeper' => 'fa-user-clock',
                                'Construction Worker' => 'fa-hammer',
                                default => 'fa-user'
                            };
                            $hourlyRate = round($rate->daily_rate / 8, 2);
                        @endphp
                        <div class="rate-card">
                            <div class="rate-card-header">
                                <div class="position-name">{{ $rate->position }}</div>
                                <div class="position-icon {{ $iconClass }}">
                                    <i class="fas {{ $icon }}"></i>
                                </div>
                            </div>
                            <div class="rate-card-body">
                                <div class="current-rate">
                                    <span class="rate-amount">₱{{ number_format($rate->daily_rate, 2) }}</span>
                                    <span class="rate-label">per day</span>
                                </div>
                                <div class="hourly-rate">
                                    <i class="fas fa-clock"></i> ₱{{ number_format($hourlyRate, 2) }}/hour (8-hour basis)
                                </div>
                                @if($rate->description)
                                    <div class="rate-description">
                                        <i class="fas fa-info-circle" style="margin-right: 4px;"></i>{{ $rate->description }}
                                    </div>
                                @endif
                                @if($rate->updatedByUser)
                                    <div class="updated-info">
                                        <i class="fas fa-edit"></i> Last updated by {{ $rate->updatedByUser->name }} on {{ $rate->updated_at->format('M d, Y H:i') }}
                                    </div>
                                @endif
                            </div>
                            <form action="{{ route('settings.salary-rates.update', $rate) }}" method="POST" class="rate-form">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>New Daily Rate (₱)</label>
                                    <input type="number" name="daily_rate" value="{{ $rate->daily_rate }}" step="0.01" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" rows="2">{{ $rate->description }}</textarea>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-save"></i> Update Rate
                                    </button>
                                    @if(!in_array($rate->position, ['Project Manager', 'Site Supervisor', 'Finance Manager', 'Quality Assurance Officer', 'HR/Timekeeper', 'Construction Worker']))
                                        <form action="{{ route('settings.salary-rates.destroy', $rate) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this position?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('partials.sidebar-js')
</body>
</html>
