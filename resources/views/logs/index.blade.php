<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Activity Logs - AJJ CRISBER Engineering Services</title>
  <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    :root {
      --accent: #1e40af;
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
      --green-600: #1e40af;

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
      font-family: 'Inter', sans-serif;
      background-color: var(--main-bg);
      color: var(--gray-700);
      transition: margin-left 0.3s ease;
    }

    .dashboard-container {
      display: flex;
      min-height: 100vh;
    }

    /* Main Content Area */
    .main-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      width: 100%;
      transition: margin-left 0.3s ease, transform 0.3s ease;
      margin-left: 0;
      transform: translateX(0);
    }

    .main-content.sidebar-closed {
      margin-left: 0;
      transform: translateX(0);
    }

    /* When sidebar is open, shift main content */
    .sidebar.open ~ .main-content {
      margin-left: 280px;
      transform: translateX(0);
    }

    @media (min-width: 769px) {
      .main-content {
        margin-left: 0;
        transform: translateX(0);
      }
      
      .sidebar.open ~ .main-content {
        margin-left: 280px;
      }
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0 !important;
        transform: translateX(0);
      }
      
      .sidebar.open ~ .main-content {
        margin-left: 0;
        transform: translateX(280px);
      }
    }

    /* Header Styles */
    .header {
      background: linear-gradient(135deg, var(--header-bg), #1e40af);
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

    /* Content Container */
    .content-container {
      flex: 1;
      padding: 30px;
      background: linear-gradient(135deg, #f7fafc, #edf2f7);
      max-width: 1400px;
      margin: 0 auto;
      width: 100%;
    }

    /* Page Title Section */
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .page-title {
      font-size: 28px;
      font-weight: 700;
      color: var(--gray-800);
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .page-title i {
      color: var(--accent);
    }

    /* Action Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .btn-primary {
      background-color: var(--accent);
      color: white;
    }

    .btn-primary:hover {
      background-color: #1e3a8a;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(22, 163, 74, 0.2);
    }

    .btn-secondary {
      background-color: #e5e7eb;
      color: var(--gray-700);
    }

    .btn-secondary:hover {
      background-color: #d1d5db;
      transform: translateY(-2px);
    }

    /* Filter Card */
    .filters-card {
      background: white;
      border-radius: 12px;
      box-shadow: var(--shadow-md);
      padding: 20px;
      margin-bottom: 25px;
    }

    .filter-row {
      display: flex;
      gap: 12px;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 0;
    }

    .filter-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .filter-group label {
      font-weight: 600;
      font-size: 13px;
      color: var(--gray-600);
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .filter-group select,
    .filter-group input {
      padding: 10px 12px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }

    .filter-group select:focus,
    .filter-group input:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
    }

    /* Table Container */
    .table-container {
      background: white;
      border-radius: 12px;
      box-shadow: var(--shadow-md);
      overflow: hidden;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background-color: #f9fafb;
      border-bottom: 2px solid #e5e7eb;
    }

    th {
      padding: 15px 20px;
      text-align: left;
      font-weight: 600;
      color: var(--gray-600);
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    td {
      padding: 15px 20px;
      border-bottom: 1px solid #e5e7eb;
      font-size: 14px;
      color: var(--gray-700);
    }

    tbody tr {
      transition: background-color 0.2s ease;
    }

    tbody tr:hover {
      background-color: #f9fafb;
    }

    tbody tr:last-child td {
      border-bottom: none;
    }

    /* Action Badge */
    .action-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      white-space: nowrap;
    }

    .action-login {
      background-color: #dbeafe;
      color: #0369a1;
    }

    .action-logout {
      background-color: #fecaca;
      color: #991b1b;
    }

    /* Pagination */
    .pagination-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 16px;
      padding: 20px 0;
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
      justify-content: center;
      gap: 12px;
    }
    .pagination-nav {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 4px;
    }
    .page-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 36px;
      height: 36px;
      padding: 0 8px;
      border: none;
      border-radius: 8px;
      background: transparent;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      user-select: none;
      -webkit-tap-highlight-color: transparent;
    }
    a.page-btn {
      color: #374151;
      text-decoration: underline;
    }
    a.page-btn:hover {
      color: #111827;
      text-decoration: underline;
      background: transparent;
    }
    span.page-btn {
      text-decoration: none;
      color: #374151;
    }
    span.page-btn.active {
      background: var(--accent);
      color: white;
      font-weight: 600;
      text-decoration: none;
      border-radius: 8px;
      padding: 0 12px;
    }
    span.page-btn.disabled {
      opacity: 0.5;
      color: #9ca3af;
      cursor: not-allowed;
      pointer-events: none;
      text-decoration: none;
    }
    .page-btn.arrow {
      font-size: 20px;
      font-weight: 400;
    }
    .page-btn.ellipsis {
      cursor: default;
      pointer-events: none;
    }

    .pagination .disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 80px 20px;
      color: var(--gray-500);
    }

    .empty-state i {
      font-size: 64px;
      margin-bottom: 20px;
      opacity: 0.3;
    }

    .empty-state h3 {
      font-size: 20px;
      font-weight: 600;
      margin: 15px 0;
      color: var(--gray-700);
    }

    .empty-state p {
      font-size: 14px;
      color: var(--gray-500);
    }

    /* Back Link */
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--accent);
      text-decoration: none;
      font-weight: 600;
      margin-top: 20px;
      transition: all 0.3s ease;
    }

    .back-link:hover {
      transform: translateX(-5px);
      color: #1e3a8a;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .content-container {
        padding: 15px;
      }

      .page-title {
        font-size: 20px;
      }

      .filter-row {
        flex-direction: column;
      }

      .filter-group {
        width: 100%;
      }

      .btn {
        width: 100%;
        justify-content: center;
      }

      th, td {
        padding: 12px 10px;
        font-size: 13px;
      }

      table {
        font-size: 12px;
      }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    @include('partials.sidebar')

    <div class="main-content" id="mainContent">
      <!-- Header -->
      <div class="header">
        <button class="header-menu" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </button>
        <div class="header-title">
          <i class="fas fa-history"></i> Activity Logs
        </div>
      </div>

      <!-- Main Content -->
      <div class="content-container">
        <!-- Page Header -->
        <div class="page-header">
          <h1 class="page-title">
            <i class="fas fa-file-alt"></i> Activity Logs
          </h1>
          <a href="{{ route('logs.export') }}" class="btn btn-secondary">
            <i class="fas fa-download"></i> Export CSV
          </a>
        </div>

        <!-- Filters -->
        <div class="filters-card">
          <form method="GET" action="{{ route('logs.filter') }}">
            <div class="filter-row">
              <div class="filter-group">
                <label for="action">Action</label>
                <select name="action" id="action">
                  <option value="">All Actions</option>
                  <option value="LOGIN" {{ request('action') === 'LOGIN' ? 'selected' : '' }}>Login</option>
                  <option value="LOGOUT" {{ request('action') === 'LOGOUT' ? 'selected' : '' }}>Logout</option>
                </select>
              </div>
              <div class="filter-group">
                <label>&nbsp;</label>
                <div style="display: flex; gap: 10px;">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filter
                  </button>
                  <a href="{{ route('logs.index') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                  </a>
                </div>
              </div>
            </div>
          </form>
        </div>

        <!-- Activity Logs Table -->
        <div class="table-container">
          @if($logs->count() > 0)
            <table>
              <thead>
                <tr>
                  <th>Date & Time</th>
                  <th>User</th>
                  <th>Email</th>
                  <th>Action</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>
                @foreach($logs as $log)
                  <tr>
                    <td>{{ $log->log_date->format('M d, Y H:i:s') }}</td>
                    <td><strong>{{ $log->user->name ?? 'Unknown' }}</strong></td>
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
                        $detailsText = '';
                        
                        if($log->action === 'LOGIN') {
                          $detailsText = 'Signed in from ' . ($details['ip_address'] ?? 'Unknown');
                        } elseif($log->action === 'LOGOUT') {
                          $detailsText = 'Session ended';
                        } elseif($log->action === 'UPDATE_MATERIAL') {
                          $changes = $details['changes'] ?? [];
                          $changedFields = [];
                          if(is_array($changes)) {
                            foreach($changes as $field => $value) {
                              $changedFields[] = ucfirst(str_replace('_', ' ', $field));
                            }
                          }
                          if(!empty($changedFields)) {
                            $detailsText = 'Updated: ' . implode(', ', array_slice($changedFields, 0, 3));
                            if(count($changedFields) > 3) {
                              $detailsText .= ' +' . (count($changedFields) - 3) . ' more';
                            }
                          } else {
                            $detailsText = 'Material record updated';
                          }
                        } else {
                          $detailsText = 'User action recorded';
                        }
                      @endphp
                      {{ $detailsText }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <div class="empty-state">
              <i class="fas fa-inbox"></i>
              <h3>No Logs Found</h3>
              <p>There are no activity logs available for this period.</p>
            </div>
          @endif
        </div>

        <!-- Pagination -->
        @if ($logs->hasPages())
          @php
            $currentPage = $logs->currentPage();
            $lastPage = $logs->lastPage();
          @endphp
          <div class="pagination-container">
            <div class="pagination-info">
              Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} logs
            </div>
            <div class="pagination-controls">
              @if ($logs->onFirstPage())
                <span class="page-btn arrow disabled">‹</span>
              @else
                <a class="page-btn arrow" href="{{ $logs->previousPageUrl() }}" rel="prev">‹</a>
              @endif

              <div class="pagination-nav">
                @if ($currentPage > 1)
                  <a class="page-btn" href="{{ $logs->url(1) }}">1</a>
                @endif
                
                @if ($currentPage > 2)
                  <span class="page-btn ellipsis">...</span>
                @endif
                
                @if ($currentPage > 2)
                  <a class="page-btn" href="{{ $logs->url($currentPage - 1) }}">{{ $currentPage - 1 }}</a>
                @endif
                
                <span class="page-btn active">{{ $currentPage }}</span>
                
                @if ($currentPage < $lastPage - 1)
                  <a class="page-btn" href="{{ $logs->url($currentPage + 1) }}">{{ $currentPage + 1 }}</a>
                @endif
                
                @if ($currentPage < $lastPage - 1)
                  <span class="page-btn ellipsis">...</span>
                @endif
                
                @if ($currentPage < $lastPage)
                  <a class="page-btn" href="{{ $logs->url($lastPage) }}">{{ $lastPage }}</a>
                @endif
              </div>

              @if ($logs->hasMorePages())
                <a class="page-btn arrow" href="{{ $logs->nextPageUrl() }}" rel="next">›</a>
              @else
                <span class="page-btn arrow disabled">›</span>
              @endif
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      const mainContent = document.getElementById('mainContent');
      
      if (sidebar) {
        sidebar.classList.toggle('open');
        mainContent.classList.toggle('sidebar-closed');
      }
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
      const sidebar = document.querySelector('.sidebar');
      const toggle = document.querySelector('.header-menu');
      
      if (window.innerWidth <= 768) {
        if (sidebar && sidebar.classList.contains('open') && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
          toggleSidebar();
        }
      }
    });
  </script>
</body>
</html>
