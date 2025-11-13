<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - AJJ CRISBER Engineering Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root{
            --accent:#16a34a; --accent-dark:#15803d; --bg-1:#f5f7fb; --bg-2:#eef2f7; --white:#fff;
            --gray-900:#0f172a; --gray-800:#1f2937; --gray-700:#334155; --gray-600:#475569; --gray-500:#64748b; --gray-300:#e5e7eb;
        }
        *{box-sizing:border-box}
        body{
            margin:0; font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif; color:var(--gray-800);
            background:
              radial-gradient(1200px 600px at -10% -10%, rgba(22,163,74,0.08), transparent 60%),
              radial-gradient(900px 400px at 110% 10%, rgba(22,163,74,0.06), transparent 60%),
              linear-gradient(135deg, var(--bg-1), var(--bg-2));
        }
        .container{min-height:100vh; display:grid; place-items:center; padding:24px}
        .card{
            width:100%; max-width:460px; background:var(--white); border:1px solid var(--gray-300);
            border-radius:16px; box-shadow: 0 20px 40px rgba(2, 6, 23, 0.08);
            padding:28px 28px 22px;
        }
        .brand{display:flex; align-items:center; gap:12px; margin-bottom:6px}
        .brand-logo{
            width:44px; height:44px; border-radius:50%; display:grid; place-items:center; font-weight:800; color:var(--accent);
            background: linear-gradient(135deg, #e6f9ee, #dff7ea);
            border:1px solid rgba(22,163,74,0.15);
        }
        .brand-title{font-family:"Zen Dots", cursive; font-size:20px; letter-spacing:.4px; color:var(--gray-900)}
        .title{font-weight:700; margin:8px 0 18px; font-size:22px}
        .field{display:flex; flex-direction:column; gap:6px; margin-bottom:14px}
        label{font-size:13px; color:var(--gray-600)}
        .input{
            height:44px; padding:10px 12px; border:1px solid var(--gray-300); border-radius:10px; outline:none; background:#fff; width:100%;
            transition:border-color .2s, box-shadow .2s;
        }
        .input:focus{border-color:var(--accent); box-shadow:0 0 0 3px rgba(22,163,74,.12)}
        .row{display:flex; align-items:center; justify-content:space-between; margin:6px 0 16px}
        .remember{display:flex; align-items:center; gap:8px; font-size:13px; color:var(--gray-600)}
        .btn{width:100%; height:46px; border-radius:10px; border:1px solid var(--accent); background:var(--accent); color:#fff; font-weight:700; cursor:pointer; box-shadow:0 6px 14px rgba(22,163,74,.18);}
        .btn:hover{background:var(--accent-dark)}
        .error{margin-top:10px; color:#b91c1c; font-size:14px}
        .error-summary{margin:10px 0; padding:10px 12px; border:1px solid #fecaca; background:#fef2f2; color:#7f1d1d; border-radius:8px; font-size:13px}
        .footer{margin-top:14px; text-align:center; font-size:12px; color:var(--gray-600)}
        .aux{display:flex; align-items:center; justify-content:space-between; margin-top:6px}
        .link{font-size:12px; color:#075985; text-decoration:none}
        .link:hover{text-decoration:underline}
    </style>
</head>
<body>
<div class="container">
    <form class="card" method="POST" action="{{ route('login.attempt') }}">
        @csrf
        <div class="brand">
            <div class="brand-logo">
                <img src="{{ asset('images/aces-logo.png') }}" alt="ACES" onerror="this.remove();" style="width:32px;height:32px;border-radius:50%" />
                <span style="position:absolute;opacity:.0">ACES</span>
            </div>
            <div class="brand-title">AJJ CRISBER Engineering Services</div>
        </div>
        <h2 class="title">Sign in</h2>
        <div class="field">
            <label for="email">Email</label>
            <input class="input" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus />
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input class="input" id="password" name="password" type="password" required />
        </div>
        @if ($errors->any())
            <div role="alert" class="error-summary">
                <strong>There were problems with your input.</strong>
            </div>
        @endif
        <div class="row">
            <label class="remember"><input type="checkbox" name="remember" /> Remember me</label>
        </div>
        <button class="btn" type="submit">Login</button>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
        <div class="aux">
            <span></span>
            <a href="#" class="link" title="Feature coming soon">Forgot password?</a>
        </div>
        <div class="footer">Single admin login</div>
    </form>
</div>
</body>
</html>
