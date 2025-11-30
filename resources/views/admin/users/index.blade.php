<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management - AJJ CRISBER Engineering Services</title>
  <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    :root {
      --accent: #16a34a;
      --white: #ffffff;
      --sidebar-bg: #f8fafc;
      --header-bg: var(--accent);
      --main-bg: #f5f7fa;

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

    /* Content Container */
    .content-container {
      flex: 1;
      padding: 30px;
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
      background-color: #15803d;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(22, 163, 74, 0.2);
    }

    /* Flash Message */
    .alert {
      padding: 15px 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
      animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
      from {
        transform: translateY(-10px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .alert-success {
      background-color: #d1fae5;
      color: #065f46;
      border-left: 4px solid var(--accent);
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

    /* Status Badge */
    .badge {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      white-space: nowrap;
    }

    .badge-role {
      background-color: #dbeafe;
      color: #0c4a6e;
    }

    .badge-verified {
      background-color: #d1fae5;
      color: #065f46;
    }

    .badge-unverified {
      background-color: #fee2e2;
      color: #7c2d12;
    }

    /* No Data Message */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: var(--gray-500);
    }

    .empty-state i {
      font-size: 48px;
      margin-bottom: 15px;
      opacity: 0.5;
    }

    .empty-state h3 {
      font-size: 18px;
      margin: 10px 0;
      color: var(--gray-600);
    }

    /* Pagination */
    .pagination-container {
      display: flex;
      justify-content: center;
      padding: 20px;
    }

    .pagination {
      display: flex;
      gap: 8px;
    }

    .pagination a,
    .pagination span {
      padding: 8px 12px;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      text-decoration: none;
      color: var(--accent);
      font-size: 13px;
      transition: all 0.3s ease;
    }

    .pagination a:hover {
      background-color: var(--accent);
      color: white;
      border-color: var(--accent);
    }

    .pagination .active {
      background-color: var(--accent);
      color: white;
      border-color: var(--accent);
    }

    .pagination .disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    /* Back Link */
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--accent);
      text-decoration: none;
      font-weight: 500;
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }

    .back-link:hover {
      transform: translateX(-5px);
      color: #15803d;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .page-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
      }

      .btn {
        width: 100%;
        justify-content: center;
      }

      .content-container {
        padding: 15px;
      }

      th, td {
        padding: 10px;
        font-size: 13px;
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
          <i class="fas fa-users-gear"></i> User Management
        </div>
      </div>

      <!-- Main Content -->
      <div class="content-container">
        <!-- Page Header -->
        <div class="page-header">
          <h1 class="page-title">
            <i class="fas fa-user-gear"></i> Manage Users
          </h1>
          <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New User
          </a>
        </div>

        <!-- Flash Message -->
        @if (session('status'))
          <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('status') }}
          </div>
        @endif

        <!-- Users Table -->
        <div class="table-container">
          @if ($users->count() > 0)
            <table>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Verified</th>
                  <th>Created</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>
                      <strong>{{ $user->name }}</strong>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <span class="badge badge-role">
                        {{ $user->role ?? 'N/A' }}
                      </span>
                    </td>
                    <td>
                      @if ($user->email_verified_at)
                        <span class="badge badge-verified">
                          <i class="fas fa-check"></i> Verified
                        </span>
                      @else
                        <span class="badge badge-unverified">
                          <i class="fas fa-times"></i> Not Verified
                        </span>
                      @endif
                    </td>
                    <td>{{ optional($user->created_at)->diffForHumans() ?? 'N/A' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <div class="empty-state">
              <i class="fas fa-inbox"></i>
              <h3>No Users Found</h3>
              <p>Start by creating your first user.</p>
            </div>
          @endif
        </div>

        <!-- Pagination -->
        @if ($users->count() > 0)
          <div class="pagination-container">
            {{ $users->links() }}
          </div>
        @endif

        <!-- Back Link -->
        <a href="{{ route('dashboard') }}" class="back-link">
          <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
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

