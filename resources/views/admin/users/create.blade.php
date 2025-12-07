<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; background: #f7fafc; color: #1f2937; transition: margin-left 0.3s ease; }
    body.sidebar-open { margin-left: 280px; }
    
    .top-header { 
      background: linear-gradient(135deg, #16a34a, #15803d); 
      color: #fff; 
      padding: 16px 24px; 
      display: flex; 
      align-items: center; 
      justify-content: space-between; 
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 10;
    }
    
    .header-left { display: flex; align-items: center; gap: 12px; }
    
    .toggle-sidebar { 
      background: none; 
      border: none; 
      color: #fff; 
      font-size: 22px; 
      cursor: pointer; 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      width: 40px; 
      height: 40px; 
      border-radius: 8px; 
      transition: all 0.2s ease; 
    }
    
    .toggle-sidebar:hover { 
      background: rgba(255,255,255,0.1); 
      transform: scale(1.1); 
    }
    
    .company-name { 
      font-size: 18px; 
      font-weight: 700;
      letter-spacing: 0.5px;
    }
    
    .main-content {
      padding: 30px;
    }
    
    .container { 
      max-width: 600px; 
      margin: 0 auto; 
      background: #fff; 
      padding: 32px; 
      border-radius: 12px; 
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .title { 
      font-size: 24px; 
      font-weight: 700; 
      margin-bottom: 24px; 
      display: flex; 
      align-items: center; 
      gap: 12px;
      color: #1f2937;
    }
    
    .title i {
      color: #16a34a;
      font-size: 28px;
    }
    
    .form-group { 
      margin-bottom: 20px; 
    }
    
    label { 
      display: block; 
      font-size: 13px; 
      color: #374151; 
      margin-bottom: 8px; 
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    input, select { 
      width: 100%; 
      padding: 12px 14px; 
      border: 1px solid #e5e7eb; 
      border-radius: 8px; 
      font-size: 14px;
      font-family: 'Inter', sans-serif;
      transition: all 0.2s ease;
    }
    
    input:focus, select:focus {
      outline: none;
      border-color: #16a34a;
      box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
    }
    
    .help { 
      font-size: 12px; 
      color: #6b7280; 
      margin-top: 8px;
      line-height: 1.4;
    }
    
    .error { 
      color: #dc2626; 
      font-size: 12px; 
      margin-top: 6px;
      display: flex;
      align-items: center;
      gap: 4px;
    }
    
    .actions { 
      display: flex; 
      gap: 12px; 
      margin-top: 28px;
      padding-top: 24px;
      border-top: 1px solid #e5e7eb;
    }
    
    .btn { 
      display: inline-flex; 
      align-items: center; 
      justify-content: center;
      gap: 8px; 
      padding: 12px 20px; 
      border-radius: 8px; 
      text-decoration: none; 
      font-weight: 600; 
      font-size: 14px;
      transition: all 0.2s ease;
      cursor: pointer;
      border: none;
    }
    
    .btn-primary { 
      background: #16a34a; 
      color: #fff;
      min-width: 120px;
    }
    
    .btn-primary:hover {
      background: #15803d;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
    }
    
    .btn-secondary { 
      background: #f3f4f6; 
      color: #111827;
      text-decoration: none;
    }
    
    .btn-secondary:hover {
      background: #e5e7eb;
      transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
      body.sidebar-open { margin-left: 0; }
      .main-content { padding: 16px; }
      .container { padding: 20px; }
      .title { font-size: 20px; }
      .actions { flex-direction: column; }
      .btn { width: 100%; }
    }
  </style>
</head>
<body>
  <div class="top-header">
    <div class="header-left">
      <button class="toggle-sidebar" onclick="toggleSidebar()">☰</button>
      <div class="company-name"><i class="fas fa-user-plus"></i> Create User</div>
    </div>
  </div>

  @include('partials.sidebar')

  <div class="main-content">
    <div class="container">
      <div class="title">
        <i class="fas fa-user-plus"></i>
        Create User
      </div>

      <form method="POST" action="{{ route('admin.users.store') }}">
      @csrf

      <div class="form-group">
        <label for="name">Full Name</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="role">Role</label>
        <select id="role" name="role" required>
          @foreach ($roles as $r)
            <option value="{{ $r }}" {{ old('role')===$r ? 'selected' : '' }}>{{ $r }}</option>
          @endforeach
        </select>
        <div class="help">OWNER has full access. PM manages projects. QA handles material checks. FM manages finance.</div>
        @error('role') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>
        @error('password') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required>
      </div>

      <div class="actions">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save"></i> Create
        </button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
          <i class="fas fa-arrow-left"></i> Cancel
        </a>
      </div>
      </form>
    </div>
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

