<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Tickets - Admin Dashboard</title>
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
            <h1 style="margin: 0; font-size: 28px; color: var(--gray-900); font-weight: 700;">Support Tickets</h1>
            <p style="margin: 4px 0 0; color: var(--gray-600); font-size: 14px;">Manage user support requests and concerns</p>
        </div>
        <div style="background: #f0f9ff; padding: 12px 16px; border-radius: 8px; border-left: 4px solid #1e40af;">
            <div style="font-size: 24px; font-weight: 700; color: #1e40af;">{{ $tickets->total() }}</div>
            <div style="font-size: 12px; color: #064e3b;">Total Tickets</div>
        </div>
    </div>

    <!-- Filters -->
    <div style="display: flex; gap: 12px; margin-bottom: 20px; background: white; padding: 16px; border-radius: 10px; border: 1px solid var(--gray-300); flex-wrap: wrap;">
        <div style="font-size: 12px; color: var(--gray-600); font-weight: 600; display: flex; align-items: center;">Status:</div>
        <a href="{{ route('admin.support.tickets', array_merge(request()->query(), ['status' => 'open'])) }}" 
            style="padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; {{ $status === 'open' ? 'background: #1e40af; color: white;' : 'background: var(--bg-1); color: var(--gray-700);' }}">
            Open
        </a>
        <a href="{{ route('admin.support.tickets', array_merge(request()->query(), ['status' => 'in_progress'])) }}" 
            style="padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; {{ $status === 'in_progress' ? 'background: #1e40af; color: white;' : 'background: var(--bg-1); color: var(--gray-700);' }}">
            In Progress
        </a>
        <a href="{{ route('admin.support.tickets', array_merge(request()->query(), ['status' => 'resolved'])) }}" 
            style="padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; {{ $status === 'resolved' ? 'background: #1e40af; color: white;' : 'background: var(--bg-1); color: var(--gray-700);' }}">
            Resolved
        </a>
        <a href="{{ route('admin.support.tickets', array_merge(request()->query(), ['status' => 'all'])) }}" 
            style="padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; {{ $status === 'all' ? 'background: #1e40af; color: white;' : 'background: var(--bg-1); color: var(--gray-700);' }}">
            All
        </a>
    </div>

    @if ($tickets->count() > 0)
        <div style="background: white; border-radius: 10px; border: 1px solid var(--gray-300); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: var(--sidebar-bg); border-bottom: 2px solid var(--gray-300);">
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--gray-700);">Ticket #</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--gray-700);">Name</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--gray-700);">Subject</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--gray-700);">Category</th>
                        <th style="padding: 12px 16px; text-align: center; font-size: 12px; font-weight: 600; color: var(--gray-700);">Priority</th>
                        <th style="padding: 12px 16px; text-align: center; font-size: 12px; font-weight: 600; color: var(--gray-700);">Status</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 600; color: var(--gray-700);">Submitted</th>
                        <th style="padding: 12px 16px; text-align: center; font-size: 12px; font-weight: 600; color: var(--gray-700);">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr style="border-bottom: 1px solid var(--gray-300); hover: background: #f9fafb;">
                            <td style="padding: 12px 16px; font-size: 13px; color: var(--gray-900); font-weight: 600;">
                                #{{ str_pad($ticket->id, 6, '0', STR_PAD_LEFT) }}
                            </td>
                            <td style="padding: 12px 16px; font-size: 13px; color: var(--gray-700);">
                                {{ $ticket->name }}
                            </td>
                            <td style="padding: 12px 16px; font-size: 13px; color: var(--gray-700);">
                                {{ Str::limit($ticket->subject, 40) }}
                            </td>
                            <td style="padding: 12px 16px; font-size: 12px; color: var(--gray-700);">
                                {{ ucwords(str_replace('_', ' ', $ticket->category)) }}
                            </td>
                            <td style="padding: 12px 16px; text-align: center;">
                                <span style="padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;
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
                                    {{ strtoupper($ticket->priority) }}
                                </span>
                            </td>
                            <td style="padding: 12px 16px; text-align: center;">
                                <span style="padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;
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
                            </td>
                            <td style="padding: 12px 16px; font-size: 13px; color: var(--gray-700);">
                                {{ $ticket->created_at->format('M d, Y') }}
                            </td>
                            <td style="padding: 12px 16px; text-align: center;">
                                <a href="{{ route('admin.support.ticket.show', $ticket->id) }}" 
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
            {{ $tickets->links() }}
        </div>
    @else
        <div style="background: white; padding: 40px; text-align: center; border-radius: 10px; border: 1px solid var(--gray-300);">
            <i class="fas fa-inbox" style="font-size: 48px; color: var(--gray-400); margin-bottom: 16px; display: block;"></i>
            <p style="color: var(--gray-600); margin: 0;">No support tickets found.</p>
        </div>
    @endif
    </div>
</body>
</html>
