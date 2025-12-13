<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Requests - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #1e40af;
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
<div style="padding: 20px;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px;">
        <div>
            <h1 style="margin: 0; font-size: 28px; color: var(--gray-900); font-weight: 700;">Password Reset Requests</h1>
            <p style="margin: 4px 0 0; color: var(--gray-600); font-size: 14px;">Manage user password reset requests</p>
        </div>
        <div style="background: #f0f9ff; padding: 12px 16px; border-radius: 8px; border-left: 4px solid #1e40af;">
            <div style="font-size: 24px; font-weight: 700; color: #1e40af;">{{ $requests->total() }}</div>
            <div style="font-size: 12px; color: #064e3b;">Total Requests</div>
        </div>
    </div>

    <!-- Filters -->
    <div style="display: flex; gap: 12px; margin-bottom: 20px; background: white; padding: 16px; border-radius: 10px; border: 1px solid var(--gray-300);">
        <a href="{{ route('admin.support.password-resets', ['status' => 'pending']) }}" 
            style="padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; {{ $status === 'pending' ? 'background: #1e40af; color: white;' : 'background: var(--bg-1); color: var(--gray-700);' }}">
            Pending
        </a>
        <a href="{{ route('admin.support.password-resets', ['status' => 'resolved']) }}" 
            style="padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; {{ $status === 'resolved' ? 'background: #1e40af; color: white;' : 'background: var(--bg-1); color: var(--gray-700);' }}">
            Resolved
        </a>
        <a href="{{ route('admin.support.password-resets', ['status' => 'rejected']) }}" 
            style="padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; {{ $status === 'rejected' ? 'background: #1e40af; color: white;' : 'background: var(--bg-1); color: var(--gray-700);' }}">
            Rejected
        </a>
        <a href="{{ route('admin.support.password-resets', ['status' => 'all']) }}" 
            style="padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; {{ $status === 'all' ? 'background: #1e40af; color: white;' : 'background: var(--bg-1); color: var(--gray-700);' }}">
            All
        </a>
    </div>

    @if ($requests->count() > 0)
        <div style="background: white; border-radius: 10px; border: 1px solid var(--gray-300); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: var(--sidebar-bg); border-bottom: 2px solid var(--gray-300);">
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--gray-700);">User</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--gray-700);">Email</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--gray-700);">Reason</th>
                        <th style="padding: 12px 16px; text-align: center; font-size: 12px; font-weight: 600; color: var(--gray-700);">Status</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--gray-700);">Requested</th>
                        <th style="padding: 12px 16px; text-align: center; font-size: 12px; font-weight: 600; color: var(--gray-700);">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr style="border-bottom: 1px solid var(--gray-300); hover: background: #f9fafb;">
                            <td style="padding: 12px 16px; font-size: 13px; color: var(--gray-900); font-weight: 500;">
                                {{ $request->user?->name ?? 'Unknown' }}
                            </td>
                            <td style="padding: 12px 16px; font-size: 13px; color: var(--gray-700);">
                                {{ $request->email }}
                            </td>
                            <td style="padding: 12px 16px; font-size: 13px; color: var(--gray-700);">
                                {{ Str::limit($request->reason ?? 'N/A', 50) }}
                            </td>
                            <td style="padding: 12px 16px; text-align: center;">
                                <span style="padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;
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
                            </td>
                            <td style="padding: 12px 16px; font-size: 13px; color: var(--gray-700);">
                                {{ $request->created_at->format('M d, Y H:i') }}
                            </td>
                            <td style="padding: 12px 16px; text-align: center;">
                                <a href="{{ route('admin.support.password-reset.show', $request->id) }}" 
                                   style="padding: 6px 12px; background: #1e40af; color: white; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="margin-top: 20px;">
            {{ $requests->links() }}
        </div>
    @else
        <div style="background: white; padding: 40px; text-align: center; border-radius: 10px; border: 1px solid var(--gray-300);">
            <i class="fas fa-inbox" style="font-size: 48px; color: var(--gray-400); margin-bottom: 16px; display: block;"></i>
            <p style="color: var(--gray-600); margin: 0;">No password reset requests found.</p>
        </div>
    @endif
    </div>
</body>
</html>