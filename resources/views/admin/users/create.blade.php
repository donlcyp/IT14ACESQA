<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    body { font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial; background:#f7fafc; color:#1f2937; }
    .container { max-width: 720px; margin: 24px auto; background:#fff; padding:24px; border-radius:12px; box-shadow:0 6px 6px rgba(0,0,0,0.08);}    
    .title { font-size:20px; font-weight:700; margin-bottom:16px; display:flex; align-items:center; gap:10px; }
    .form-group { margin-bottom:14px; }
    label { display:block; font-size:14px; color:#374151; margin-bottom:6px; font-weight:600; }
    input, select { width:100%; padding:10px 12px; border:1px solid #e5e7eb; border-radius:8px; font-size:14px; }
    .help { font-size:12px; color:#6b7280; margin-top:6px; }
    .error { color:#b91c1c; font-size:12px; margin-top:6px; }
    .actions { display:flex; gap:8px; margin-top:16px; }
    .btn { display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:8px; text-decoration:none; font-weight:600; font-size:14px; }
    .btn-primary { background:#16a34a; color:#fff; border:none; cursor:pointer; }
    .btn-secondary { background:#f3f4f6; color:#111827; text-decoration:none; }
  </style>
</head>
<body>
  <div class="container">
    <div class="title"><i class="fas fa-user-plus"></i> Create New User</div>

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
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
