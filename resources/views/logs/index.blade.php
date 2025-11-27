<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Activity Logs</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial; background:#f7fafc; color:#1f2937; transition: margin-left 0.3s ease; }
    body.sidebar-open { margin-left: 280px; }
    .top-header { background: linear-gradient(135deg, #16a34a, #15803d); color: #fff; padding: 16px 24px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .header-left { display: flex; align-items: center; gap: 12px; }
    .toggle-sidebar { background: none; border: none; color: #fff; font-size: 22px; cursor: pointer; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; transition: all 0.2s ease; }
    .toggle-sidebar:hover { background: rgba(255,255,255,0.1); transform: scale(1.1); opacity: 0.9; }
    .company-name { font-size: 18px; font-weight: 700; }
    .container { max-width: 1200px; margin: 24px auto; background:#fff; padding:24px; border-radius:12px; box-shadow:0 6px 6px rgba(0,0,0,0.08);}    
    .header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
    .title { font-size:20px; font-weight:700; }
    .btn { display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:8px; text-decoration:none; font-weight:600; font-size:14px; border: none; cursor: pointer; transition: all 0.2s; }
    .btn-primary { background:#16a34a; color:#fff; }
    .btn-primary:hover { background:#15803d; }
    .btn-secondary { background:#e5e7eb; color:#111827; }
    .btn-secondary:hover { background:#d1d5db; }
    .filters { display: flex; gap: 12px; margin-bottom: 20px; align-items: center; flex-wrap: wrap; }
    .filter-group { display: flex; gap: 8px; align-items: center; }
    .filter-group label { font-weight: 600; color: #6b7280; font-size: 14px; }
    .filter-group select, .filter-group input { padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; }
    table { width:100%; border-collapse: collapse; }
    th { text-align:left; font-size:12px; color:#6b7280; text-transform:uppercase; letter-spacing:0.06em; padding:12px; border-bottom:2px solid #e5e7eb; font-weight: 600; }
    td { padding:12px; border-bottom:1px solid #e5e7eb; font-size:14px; }
    tr:hover { background: #f9fafb; }
    .action-badge { display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; }
    .action-login { background: #dbeafe; color: #0369a1; }
    .action-logout { background: #fecaca; color: #991b1b; }
    .pagination { display: flex; gap: 8px; margin-top: 20px; justify-content: center; }
    .pagination a, .pagination span { padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; text-decoration: none; color: #374151; font-size: 14px; }
    .pagination a:hover { background: #f3f4f6; }
    .pagination .active { background: #16a34a; color: #fff; border-color: #16a34a; }
    .empty-state { text-align: center; padding: 40px 20px; color: #9ca3af; }
    .empty-state i { font-size: 48px; opacity: 0.3; margin-bottom: 15px; }
  </style>
</head>
<body>
  <div class="top-header">
    <div class="header-left">
      <button class="toggle-sidebar" onclick="toggleSidebar()">☰</button>
      <div class="company-name"><i class="fas fa-history"></i> Activity Logs</div>
    </div>
  </div>

  @include('partials.sidebar')

  <div class="container">
    <div class="header">
      <div class="title"><i class="fas fa-log-in"></i> User Activity Log</div>
      <a href="{{ route('logs.export') }}" class="btn btn-secondary">
        <i class="fas fa-download"></i> Export CSV
      </a>
    </div>

    <div class="filters">
      <form method="GET" action="{{ route('logs.filter') }}" style="display: flex; gap: 12px; width: 100%; flex-wrap: wrap; align-items: center;">
        <div class="filter-group">
          <label for="action">Action:</label>
          <select name="action" id="action">
            <option value="">All Actions</option>
            <option value="LOGIN" {{ request('action') === 'LOGIN' ? 'selected' : '' }}>Login</option>
            <option value="LOGOUT" {{ request('action') === 'LOGOUT' ? 'selected' : '' }}>Logout</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-filter"></i> Filter
        </button>
        <a href="{{ route('logs.index') }}" class="btn btn-secondary">
          <i class="fas fa-redo"></i> Reset
        </a>
      </form>
    </div>

    @if($logs->count() > 0)
      <table>
        <thead>
          <tr>
            <th>Date & Time</th>
            <th>User</th>
            <th>Email</th>
            <th>Action</th>
            <th>IP Address</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          @foreach($logs as $log)
            <tr>
              <td>{{ $log->log_date->format('M d, Y H:i:s') }}</td>
              <td>{{ $log->user->name ?? 'Unknown' }}</td>
              <td>{{ $log->user->email ?? 'N/A' }}</td>
              <td>
                <span class="action-badge action-{{ strtolower($log->action) }}">
                  @if($log->action === 'LOGIN')
                    <i class="fas fa-sign-in-alt"></i> Login
                  @elseif($log->action === 'LOGOUT')
                    <i class="fas fa-sign-out-alt"></i> Logout
                  @else
                    {{ $log->action }}
                  @endif
                </span>
              </td>
              <td>
                @php
                  $details = json_decode($log->details, true);
                  $ip = $details['ip_address'] ?? 'N/A';
                @endphp
                {{ $ip }}
              </td>
              <td style="font-size: 12px; color: #6b7280;">
                @php
                  $details = json_decode($log->details, true);
                @endphp
                @if($log->action === 'LOGIN')
                  Signed in from {{ $details['ip_address'] ?? 'Unknown' }}
                @elseif($log->action === 'LOGOUT')
                  Session duration: {{ isset($details['session_duration']) ? gmdate('H:i:s', $details['session_duration']) : 'N/A' }}
                @else
                  {{ $log->details ?? 'No details' }}
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="pagination">
        {{ $logs->links() }}
      </div>
    @else
      <div class="empty-state">
        <i class="fas fa-inbox"></i>
        <h3>No logs found</h3>
        <p>No activity logs available for this period.</p>
      </div>
    @endif
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      const body = document.body;
      sidebar.classList.toggle('open');
      body.classList.toggle('sidebar-open');
    }
    
    document.addEventListener('click', function(e) {
      const sidebar = document.querySelector('.sidebar');
      const toggle = document.querySelector('.toggle-sidebar');
      if (sidebar && sidebar.classList.contains('open') && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
        toggleSidebar();
      }
    });
  </script>
</body>
</html>
