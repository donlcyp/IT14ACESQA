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
      --accent: #1e40af;
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
      --red-600: #dc2626;
      --green-600: #047857;

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
      color: #0c4a6e;
    }

    .badge-verified {
      color: #065f46;
    }

    .badge-unverified {
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

    /* Action Buttons */
    .btn-action {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 6px;
      background-color: var(--accent);
      color: white;
      text-decoration: none;
      font-size: 16px;
      transition: all 0.2s ease;
      cursor: pointer;
    }

    .btn-action:hover {
      background-color: #15803d;
      transform: scale(1.1);
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

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      animation: fadeIn 0.3s ease;
    }

    .modal.show {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .modal-content {
      background-color: #fff;
      padding: 32px;
      border-radius: 12px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      animation: slideUp 0.3s ease;
      max-height: 90vh;
      overflow-y: auto;
    }

    @keyframes slideUp {
      from {
        transform: translateY(20px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .modal-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
      padding-bottom: 16px;
      border-bottom: 1px solid #e5e7eb;
    }

    .modal-title {
      font-size: 24px;
      font-weight: 700;
      color: #1f2937;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .modal-title i {
      color: var(--accent);
      font-size: 28px;
    }

    .modal-close {
      background: none;
      border: none;
      font-size: 24px;
      color: #6b7280;
      cursor: pointer;
      padding: 0;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }

    .modal-close:hover {
      color: #111827;
      background: #f3f4f6;
      border-radius: 6px;
    }

    .modal-body {
      margin-bottom: 24px;
    }

    .form-group-modal {
      margin-bottom: 20px;
    }

    .form-group-modal label {
      display: block;
      font-size: 13px;
      color: #374151;
      margin-bottom: 8px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-group-modal input,
    .form-group-modal select {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      font-size: 14px;
      font-family: 'Inter', sans-serif;
      transition: all 0.2s ease;
    }

    .form-group-modal input:focus,
    .form-group-modal select:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
    }

    .form-help {
      font-size: 12px;
      color: #6b7280;
      margin-top: 8px;
      line-height: 1.4;
    }

    .modal-footer {
      display: flex;
      gap: 12px;
      padding-top: 24px;
      border-top: 1px solid #e5e7eb;
    }

    .modal-footer .btn {
      flex: 1;
      min-width: 100px;
    }

    /* View Modal Details */
    .modal-details {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px;
    }

    .detail-item {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .detail-item-label {
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #6b7280;
    }

    .detail-item-value {
      font-size: 16px;
      font-weight: 500;
      color: #1f2937;
    }

    .detail-badge {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
      width: fit-content;
    }

    .detail-badge.verified {
      background-color: #d1fae5;
      color: #065f46;
    }

    .detail-badge.unverified {
      background-color: #fee2e2;
      color: #7c2d12;
    }

    @media (max-width: 600px) {
      .modal-details {
        grid-template-columns: 1fr;
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
          <button onclick="openCreateUserModal()" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New User
          </button>
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
                  <th>Phone</th>
                  <th>Role</th>
                  <th>Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>
                      <strong>{{ $user->name }}</strong>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? 'N/A' }}</td>
                    <td>
                      <span class="badge badge-role">
                        {{ $user->role ?? 'N/A' }}
                      </span>
                    </td>
                    <td>{{ optional($user->created_at)->diffForHumans() ?? 'N/A' }}</td>
                    <td>
                      <a href="#" onclick="openViewUserModal({{ json_encode($user) }}); return false;" class="btn-action" title="View user details">
                        <i class="fas fa-folder-open"></i>
                      </a>
                    </td>
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
        @if ($users->hasPages())
          @php
            $currentPage = $users->currentPage();
            $lastPage = $users->lastPage();
          @endphp
          <div class="pagination-container">
            <div class="pagination-info">
              Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
            </div>
            <div class="pagination-controls">
              @if ($users->onFirstPage())
                <span class="page-btn arrow disabled">‹</span>
              @else
                <a class="page-btn arrow" href="{{ $users->previousPageUrl() }}" rel="prev">‹</a>
              @endif

              <div class="pagination-nav">
                @if ($currentPage > 1)
                  <a class="page-btn" href="{{ $users->url(1) }}">1</a>
                @endif
                
                @if ($currentPage > 2)
                  <span class="page-btn ellipsis">...</span>
                @endif
                
                @if ($currentPage > 2)
                  <a class="page-btn" href="{{ $users->url($currentPage - 1) }}">{{ $currentPage - 1 }}</a>
                @endif
                
                <span class="page-btn active">{{ $currentPage }}</span>
                
                @if ($currentPage < $lastPage - 1)
                  <a class="page-btn" href="{{ $users->url($currentPage + 1) }}">{{ $currentPage + 1 }}</a>
                @endif
                
                @if ($currentPage < $lastPage - 1)
                  <span class="page-btn ellipsis">...</span>
                @endif
                
                @if ($currentPage < $lastPage)
                  <a class="page-btn" href="{{ $users->url($lastPage) }}">{{ $lastPage }}</a>
                @endif
              </div>

              @if ($users->hasMorePages())
                <a class="page-btn arrow" href="{{ $users->nextPageUrl() }}" rel="next">›</a>
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

  <!-- Create User Modal -->
  <div id="createUserModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
          <i class="fas fa-user-plus"></i>
          Create User
        </div>
      </div>

      <form method="POST" action="{{ route('admin.users.store') }}" class="modal-body">
        @csrf

        <div class="form-group-modal">
          <label for="name">Full Name</label>
          <input id="name" name="name" type="text" value="{{ old('name') }}" required>
          @error('name') <div class="error" style="color:#dc2626; font-size:12px; margin-top:6px;">{{ $message }}</div> @enderror
        </div>

        <div class="form-group-modal">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required>
          @error('email') <div class="error" style="color:#dc2626; font-size:12px; margin-top:6px;">{{ $message }}</div> @enderror
        </div>

        <div class="form-group-modal">
          <label for="phone">Phone</label>
          <input id="phone" name="phone" type="text" value="{{ old('phone') }}" placeholder="e.g. +63-917-123-4567">
          @error('phone') <div class="error" style="color:#dc2626; font-size:12px; margin-top:6px;">{{ $message }}</div> @enderror
        </div>

        <div class="form-group-modal">
          <label for="role">Role</label>
          <select id="role" name="role" required>
            @foreach ($roles as $r)
              <option value="{{ $r }}" {{ old('role')===$r ? 'selected' : '' }}>{{ $r }}</option>
            @endforeach
          </select>
          <div class="form-help">OWNER has full access (hidden once assigned). PM = Project Manager. SS = Site Supervisor. FM = Finance Manager. HR = Human Resource/Timekeeper. QA = Quality Assurance Officer. CW = Construction Worker.</div>
          @error('role') <div class="error" style="color:#dc2626; font-size:12px; margin-top:6px;">{{ $message }}</div> @enderror
        </div>

        <div class="form-group-modal">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" required>
          @error('password') <div class="error" style="color:#dc2626; font-size:12px; margin-top:6px;">{{ $message }}</div> @enderror
        </div>

        <div class="form-group-modal">
          <label for="password_confirmation">Confirm Password</label>
          <input id="password_confirmation" name="password_confirmation" type="password" required>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Create
          </button>
          <button type="button" onclick="closeCreateUserModal()" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cancel
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openCreateUserModal() {
      document.getElementById('createUserModal').classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    function closeCreateUserModal() {
      document.getElementById('createUserModal').classList.remove('show');
      document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById('createUserModal');
      if (event.target === modal) {
        closeCreateUserModal();
      }
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeCreateUserModal();
      }
    });

    // Phone number formatting: +63-XXX-XXX-XXXX
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
      phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.length > 0) {
          // Remove leading 63 if present (will be added with +)
          if (value.startsWith('63')) {
            value = value.substring(2);
          }
          // Limit to 10 digits after country code
          if (value.length > 10) {
            value = value.substring(0, 10);
          }
          
          if (value.length >= 1) {
            const part1 = value.substring(0, 3);
            const part2 = value.substring(3, 6);
            const part3 = value.substring(6, 10);
            
            e.target.value = '+63-' + part1 + (part2 ? '-' + part2 : '') + (part3 ? '-' + part3 : '');
          }
        }
      });
    }
  </script>

  <!-- View User Modal -->
  <div id="viewUserModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
          <i class="fas fa-user"></i>
          User Details
        </div>
        <button type="button" onclick="closeViewUserModal()" class="modal-close" title="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="modal-body">
        <div class="modal-details">
          <div class="detail-item">
            <div class="detail-item-label">Full Name</div>
            <div class="detail-item-value" id="viewUserName">—</div>
          </div>
          <div class="detail-item">
            <div class="detail-item-label">Email</div>
            <div class="detail-item-value" id="viewUserEmail">—</div>
          </div>
          <div class="detail-item">
            <div class="detail-item-label">Phone</div>
            <div class="detail-item-value" id="viewUserPhone">—</div>
          </div>
          <div class="detail-item">
            <div class="detail-item-label">Role</div>
            <div class="detail-item-value" id="viewUserRole">—</div>
          </div>
          <div class="detail-item">
            <div class="detail-item-label">Created</div>
            <div class="detail-item-value" id="viewUserCreated">—</div>
          </div>
          <div class="detail-item">
            <div class="detail-item-label">ID</div>
            <div class="detail-item-value" id="viewUserId">—</div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
      </div>
    </div>
  </div>

  <script>
    function openViewUserModal(user) {
      document.getElementById('viewUserName').textContent = user.name || '—';
      document.getElementById('viewUserEmail').textContent = user.email || '—';
      document.getElementById('viewUserPhone').textContent = user.phone || '—';
      document.getElementById('viewUserRole').textContent = user.role || 'N/A';
      document.getElementById('viewUserId').textContent = user.id || '—';
      
      // Format created date
      if (user.created_at) {
        const date = new Date(user.created_at);
        document.getElementById('viewUserCreated').textContent = date.toLocaleDateString('en-US', { 
          year: 'numeric', 
          month: 'short', 
          day: 'numeric' 
        });
      }
      
      document.getElementById('viewUserModal').classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    function closeViewUserModal() {
      document.getElementById('viewUserModal').classList.remove('show');
      document.body.style.overflow = 'auto';
    }

    // Close view modal when clicking outside
    document.addEventListener('click', function(event) {
      const modal = document.getElementById('viewUserModal');
      if (event.target === modal) {
        closeViewUserModal();
      }
    });

    // Close view modal with Escape key
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeViewUserModal();
      }
    });
  </script>
</body>
</html>

