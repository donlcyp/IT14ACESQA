<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket Details - Admin Dashboard</title>
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
<div style="padding: 20px; max-width: 1000px; margin: 0 auto;">
    <a href="{{ route('admin.support.tickets') }}" style="display: inline-flex; align-items: center; gap: 6px; color: #2563eb; text-decoration: none; font-size: 13px; margin-bottom: 20px;">
        <i class="fas fa-arrow-left"></i> Back to Tickets
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

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
        <!-- Main Content -->
        <div>
            <div style="background: white; border-radius: 10px; border: 1px solid var(--gray-300); padding: 24px; margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px;">
                    <div>
                        <h2 style="margin: 0 0 4px; font-size: 20px; color: var(--gray-900); font-weight: 700;">
                            #{{ str_pad($ticket->id, 6, '0', STR_PAD_LEFT) }} - {{ $ticket->subject }}
                        </h2>
                        <p style="margin: 0; font-size: 12px; color: var(--gray-600);">Submitted {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>
                    <span style="padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;
                        @if ($ticket->priority === 'urgent')
                            background: #fee2e2; color: #991b1b;
                        @elseif ($ticket->priority === 'high')
                            background: #fecaca; color: #7f1d1d;
                        @elseif ($ticket->priority === 'medium')
                            background: #fef3c7; color: #92400e;
                        @else
                            background: #dbeafe; color: #1e40af;
                        @endif
                    ">
                        {{ strtoupper($ticket->priority) }} PRIORITY
                    </span>
                </div>

                <!-- User Info -->
                <div style="background: var(--bg-1); padding: 16px; border-radius: 8px; margin-bottom: 20px;">
                    <h3 style="margin: 0 0 12px; font-size: 13px; color: var(--gray-600); font-weight: 600;">Customer Information</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <label style="display: block; font-size: 11px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Name</label>
                            <p style="margin: 0; font-size: 13px; color: var(--gray-900);">{{ $ticket->name }}</p>
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Email</label>
                            <p style="margin: 0; font-size: 13px; color: var(--gray-900);">
                                <a href="mailto:{{ $ticket->email }}" style="color: #2563eb; text-decoration: none;">{{ $ticket->email }}</a>
                            </p>
                        </div>
                        @if ($ticket->gmail_account)
                            <div>
                                <label style="display: block; font-size: 11px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Gmail Account</label>
                                <p style="margin: 0; font-size: 13px; color: var(--gray-900);">
                                    <a href="mailto:{{ $ticket->gmail_account }}" style="color: #2563eb; text-decoration: none;">{{ $ticket->gmail_account }}</a>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Concern -->
                <div style="margin-bottom: 20px;">
                    <h3 style="margin: 0 0 12px; font-size: 13px; color: var(--gray-600); font-weight: 600;">Customer Concern</h3>
                    <p style="margin: 0; font-size: 13px; color: var(--gray-900); line-height: 1.6; background: white; padding: 16px; border: 1px solid var(--gray-300); border-radius: 6px;">
                        {{ nl2br($ticket->concern) }}
                    </p>
                </div>

                <!-- Admin Response -->
                @if ($ticket->admin_response)
                    <div style="background: #f0f9ff; border: 1px solid #bfdbfe; padding: 16px; border-radius: 8px; margin-bottom: 20px;">
                        <h3 style="margin: 0 0 12px; font-size: 13px; color: #1e40af; font-weight: 600;">
                            <i class="fas fa-reply" style="margin-right: 6px;"></i> Admin Response
                        </h3>
                        <p style="margin: 0; font-size: 13px; color: var(--gray-900); line-height: 1.6;">
                            {{ nl2br($ticket->admin_response) }}
                        </p>
                        <p style="margin: 8px 0 0; font-size: 11px; color: #1e40af;">
                            Responded {{ $ticket->responded_at?->format('M d, Y H:i A') ?? 'N/A' }}
                        </p>
                    </div>
                @endif

                @if ($ticket->status !== 'closed')
                    <!-- Respond Form -->
                    <form method="POST" action="{{ route('admin.support.ticket.respond', $ticket->id) }}" style="margin-top: 20px;">
                        @csrf

                        <h3 style="margin: 0 0 16px; font-size: 13px; color: var(--gray-600); font-weight: 600;">Send Response</h3>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">Response Message *</label>
                            <textarea name="response" required style="width: 100%; padding: 12px; border: 1px solid var(--gray-300); border-radius: 6px; font-size: 13px; font-family: inherit; resize: vertical; min-height: 120px;" placeholder="Write your response to the customer..."></textarea>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 6px;">Mark as *</label>
                            <select name="status" required style="width: 100%; padding: 10px 12px; border: 1px solid var(--gray-300); border-radius: 6px; font-size: 13px;">
                                <option value="">-- Select status --</option>
                                <option value="in_progress">In Progress</option>
                                <option value="resolved">Resolved</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>

                        <button type="submit" style="padding: 10px 24px; background: #1e40af; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 600;">
                            <i class="fas fa-paper-plane" style="margin-right: 6px;"></i> Send Response
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <div style="background: white; border-radius: 10px; border: 1px solid var(--gray-300); padding: 20px;">
                <h3 style="margin: 0 0 16px; font-size: 14px; color: var(--gray-900); font-weight: 600;">Ticket Details</h3>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 11px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Status</label>
                    <span style="display: inline-block; padding: 6px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;
                        @if ($ticket->status === 'open')
                            background: #fef3c7; color: #92400e;
                        @elseif ($ticket->status === 'in_progress')
                            background: #dbeafe; color: #1e40af;
                        @elseif ($ticket->status === 'resolved')
                            background: #dcfce7; color: #166534;
                        @else
                            background: #f3f4f6; color: #374151;
                        @endif
                    ">
                        {{ strtoupper(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 11px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Category</label>
                    <p style="margin: 0; font-size: 13px; color: var(--gray-900);">
                        {{ ucwords(str_replace('_', ' ', $ticket->category)) }}
                    </p>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 11px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Priority</label>
                    <p style="margin: 0; font-size: 13px; color: var(--gray-900);">
                        {{ ucfirst($ticket->priority) }}
                    </p>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 11px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Created</label>
                    <p style="margin: 0; font-size: 13px; color: var(--gray-900);">
                        {{ $ticket->created_at->format('M d, Y H:i A') }}
                    </p>
                </div>

                @if ($ticket->responded_at)
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-size: 11px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Last Response</label>
                        <p style="margin: 0; font-size: 13px; color: var(--gray-900);">
                            {{ $ticket->responded_at->format('M d, Y H:i A') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
