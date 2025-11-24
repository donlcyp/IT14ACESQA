<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Users</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    body { font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial; background:#f7fafc; color:#1f2937; }
    .container { max-width: 1100px; margin: 24px auto; background:#fff; padding:24px; border-radius:12px; box-shadow:0 6px 6px rgba(0,0,0,0.08);}    
    .header { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
    .title { font-size:20px; font-weight:700; }
    .btn { display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:8px; text-decoration:none; font-weight:600; font-size:14px; }
    .btn-primary { background:#16a34a; color:#fff; }
    .status { padding:6px 10px; border-radius:999px; font-size:12px; font-weight:600; background:#f3f4f6; }
    table { width:100%; border-collapse: collapse; }
    th { text-align:left; font-size:12px; color:#6b7280; text-transform:uppercase; letter-spacing:0.06em; padding-bottom:10px; border-bottom:1px solid #e5e7eb; }
    td { padding:12px 0; border-bottom:1px solid #e5e7eb; font-size:14px; }
    .flash { background:#ecfdf5; color:#065f46; padding:10px 12px; border-radius:8px; margin-bottom:12px; font-size:14px; }
    .pagination { display:flex; gap:8px; margin-top:16px; }
    .pagination a, .pagination span { padding:6px 10px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#374151; font-size:13px; }
    .sidebar-link { display:inline-flex; align-items:center; gap:6px; margin-bottom:12px; color:#16a34a; text-decoration:none; font-weight:600; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="title"><i class="fas fa-user-gear"></i> User Management</div>
      <a class="btn btn-primary" href="{{ route('admin.users.create') }}"><i class="fas fa-plus"></i> New User</a>
    </div>

    @if (session('status'))
      <div class="flash">{{ session('status') }}</div>
    @endif

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
        @forelse ($users as $u)
          <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td><span class="status">{{ $u->role ?? '—' }}</span></td>
            <td>{{ $u->email_verified_at ? 'Yes' : 'No' }}</td>
            <td>{{ optional($u->created_at)->diffForHumans() }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" style="color:#6b7280; padding:12px 0;">No users found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div class="pagination">
      {{ $users->links('custom.pagination') }}
    </div>

    <div style="margin-top:16px;">
      <a class="sidebar-link" href="{{ route('dashboard') }}"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>
  </div>
</body>
</html>
