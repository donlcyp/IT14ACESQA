<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request Details - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #16a34a;
            --white: #ffffff;
            --sidebar-bg: #f8fafc;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-900: #111827;
            --bg-1: #f3f4f6;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Inter", sans-serif;
            background-color: #f9fafb;
            color: var(--gray-700);
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="main-content">
<div style="padding: 20px; max-width: 900px; margin: 0 auto;">
    <a href="{{ route('admin.support.password-resets') }}" style="display: inline-flex; align-items: center; gap: 6px; color: #2563eb; text-decoration: none; font-size: 13px; margin-bottom: 20px;">
        <i class="fas fa-arrow-left"></i> Back to Requests
    </a>

    @if (session('success'))
        <div style="background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
            <strong>Error!</strong> {{ session('error') }}
        </div>
    @endif

    <div style="background: white; border-radius: 10px; border: 1px solid var(--gray-300); padding: 24px; margin-bottom: 20px;">
        <h2 style="margin: 0 0 20px; font-size: 22px; color: var(--gray-900); font-weight: 700;">Password Reset Request</h2>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
            <div>
                <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">User Name</label>
                <p style="margin: 0; font-size: 14px; color: var(--gray-900); font-weight: 500;">{{ $request->user?->name ?? 'Unknown' }}</p>
            </div>
            <div>
                <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">Email</label>
                <p style="margin: 0; font-size: 14px; color: var(--gray-900); font-weight: 500;">{{ $request->email }}</p>
            </div>
            <div>
                <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">Status</label>
                <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;
                    @if ($request->status === 'pending')
                        background: #fef3c7; color: #92400e;
                    @elseif ($request->status === 'resolved')
                        background: #dcfce7; color: #166534;
                    @else
                        background: #fee2e2; color: #991b1b;
                    @endif
                ">
                    {{ strtoupper($request->status) }}
                </span>
            </div>
            <div>
                <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">Requested</label>
                <p style="margin: 0; font-size: 14px; color: var(--gray-900); font-weight: 500;">{{ $request->created_at->format('M d, Y H:i A') }}</p>
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">Reason</label>
            <p style="margin: 0; font-size: 14px; color: var(--gray-900); line-height: 1.6; background: var(--bg-1); padding: 12px; border-radius: 6px;">
                {{ $request->reason ?? 'No reason provided' }}
            </p>
        </div>

        @if ($request->admin_notes)
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">Admin Notes</label>
                <p style="margin: 0; font-size: 14px; color: var(--gray-900); line-height: 1.6; background: #fef3c7; padding: 12px; border-radius: 6px; border-left: 4px solid #f59e0b;">
                    {{ $request->admin_notes }}
                </p>
            </div>
        @endif

        @if ($request->status === 'pending')
            <!-- Resolve Password Reset -->
            <form method="POST" action="{{ route('admin.support.password-reset.resolve', $request->id) }}" style="margin-bottom: 20px;">
                @csrf

                <div style="background: #f0f9ff; border: 1px solid #bfdbfe; padding: 16px; border-radius: 8px; margin-bottom: 20px;">
                    <h3 style="margin: 0 0 12px; font-size: 14px; color: #1e40af; font-weight: 600;">
                        <i class="fas fa-check-circle" style="margin-right: 6px;"></i> Resolve & Send New Password
                    </h3>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">New Password *</label>
                        <input type="password" name="new_password" required style="width: 100%; padding: 10px 12px; border: 1px solid var(--gray-300); border-radius: 6px; font-size: 13px;" placeholder="Enter a secure password">
                        <small style="display: block; margin-top: 4px; color: var(--gray-600);">Minimum 8 characters. This will be sent to the user's email.</small>
                    </div>

                    <div style="margin-bottom: 12px;">
                        <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">Notes (Optional)</label>
                        <textarea name="admin_notes" style="width: 100%; padding: 10px 12px; border: 1px solid var(--gray-300); border-radius: 6px; font-size: 13px; font-family: inherit; resize: vertical; min-height: 80px;" placeholder="Add any notes about this password reset..."></textarea>
                    </div>

                    <button type="submit" style="padding: 10px 20px; background: #16a34a; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 600;">
                        <i class="fas fa-check" style="margin-right: 6px;"></i> Resolve & Send Password
                    </button>
                </div>
            </form>

            <!-- Reject Password Reset -->
            <form method="POST" action="{{ route('admin.support.password-reset.reject', $request->id) }}" style="margin-bottom: 20px;">
                @csrf

                <div style="background: #fef2f2; border: 1px solid #fecaca; padding: 16px; border-radius: 8px;">
                    <h3 style="margin: 0 0 12px; font-size: 14px; color: #991b1b; font-weight: 600;">
                        <i class="fas fa-times-circle" style="margin-right: 6px;"></i> Reject Request
                    </h3>

                    <div style="margin-bottom: 12px;">
                        <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">Rejection Reason *</label>
                        <textarea name="rejection_reason" required style="width: 100%; padding: 10px 12px; border: 1px solid var(--gray-300); border-radius: 6px; font-size: 13px; font-family: inherit; resize: vertical; min-height: 80px;" placeholder="Why are you rejecting this request?"></textarea>
                    </div>

                    <button type="submit" style="padding: 10px 20px; background: #dc2626; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 600;">
                        <i class="fas fa-times" style="margin-right: 6px;"></i> Reject Request
                    </button>
                </div>
            </form>
        @endif
    </div>
</body>
</html>
