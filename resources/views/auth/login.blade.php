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
            --accent:#1e40af; --accent-dark:#1e3a8a; --bg-1:#f5f7fb; --bg-2:#eef2f7; --white:#fff;
            --gray-900:#0f172a; --gray-800:#1f2937; --gray-700:#334155; --gray-600:#475569; --gray-500:#64748b; --gray-300:#e5e7eb;
            --brand-red:#e11d48; --btn-dark:#0b1220; --btn-dark-hover:#0f172a;
        }
        *{box-sizing:border-box}
        body{
            margin:0; font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif; color:var(--gray-800);
            background: linear-gradient(135deg, var(--bg-1), var(--bg-2));
        }
        .container{min-height:100vh; display:grid; grid-template-columns: 1fr 1fr; }
        .hero{
            background: radial-gradient(1000px 600px at 10% 20%, rgba(30,64,175,.25), transparent 60%),
                        linear-gradient(135deg, #0369a1, #1e40af);
            display:flex; align-items:flex-end; padding:48px; color:#ecfdf5;
        }
        .hero-inner{max-width:520px}
        .hero-title{font-weight:700; font-size:28px; margin:0 0 10px}
        .hero-sub{opacity:.9; line-height:1.5}
        .panel{display:flex; align-items:center; justify-content:center; padding:24px}
        .card{
            width:100%; max-width:460px; background:var(--white); border:1px solid var(--gray-300);
            border-radius:16px; box-shadow: 0 20px 40px rgba(2, 6, 23, 0.08);
            padding:28px 28px 22px;
        }
        .brand{display:flex; align-items:center; gap:10px; margin-bottom:8px}
        .brand-icon{color:var(--brand-red); font-size:22px}
        .brand-title{font-weight:700; font-size:18px; color:#991b1b}
        .welcome{font-weight:700; font-size:20px; color:var(--gray-900); margin:6px 0 2px}
        .welcome-sub{font-size:14px; color:var(--gray-600); margin:0 0 16px}
        .field{display:flex; flex-direction:column; gap:6px; margin-bottom:14px}
        label{font-size:13px; color:var(--gray-600)}
        .input-group{position:relative}
        .input-icon{position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#94a3b8}
        .input{height:44px; padding:10px 12px 10px 36px; border:1px solid var(--gray-300); border-radius:10px; outline:none; background:#eef2f7; width:100%; transition:border-color .2s, box-shadow .2s;}
        .input:focus{border-color:var(--accent); box-shadow:0 0 0 3px rgba(22,163,74,.12)}
        .row{display:flex; align-items:center; justify-content:space-between; margin:6px 0 16px}
        .remember{display:flex; align-items:center; gap:8px; font-size:13px; color:var(--gray-600)}
        .btn{width:100%; height:46px; border-radius:10px; border:1px solid var(--btn-dark); background:var(--btn-dark); color:#fff; font-weight:700; cursor:pointer; box-shadow:0 6px 14px rgba(2,6,23,.18);}
        .btn:hover{filter:brightness(0.9)}
        .error{margin-top:10px; color:#b91c1c; font-size:14px}
        .error-summary{margin:10px 0; padding:10px 12px; border:1px solid #fecaca; background:#fef2f2; color:#7f1d1d; border-radius:8px; font-size:13px}
        .footer{margin-top:14px; text-align:center; font-size:12px; color:var(--gray-600)}
        .aux{display:flex; align-items:center; justify-content:space-between; margin-top:6px}
        .link{font-size:12px; color:#2563eb; text-decoration:none}
        .link:hover{text-decoration:underline}
        .help-section{margin-top:16px; padding-top:16px; border-top:1px solid var(--gray-300); display:flex; gap:12px; font-size:12px}
        .help-item{flex:1}
        .help-item a{display:flex; align-items:center; gap:6px; color:#2563eb; text-decoration:none}
        .help-item a:hover{text-decoration:underline}
        @media (max-width: 960px){ .container{grid-template-columns:1fr;} .hero{display:none;} }
    </style>
</head>
<body>
<div class="container">
    <section class="hero">
        <div class="hero-inner">
            <h1 class="hero-title">AJJ CRISBER Engineering Services</h1>
            <p class="hero-sub">Access your engineering projects, monitor systems, and manage operations—all in one place.</p>
        </div>
    </section>
    <section class="panel">
    <form class="card" method="POST" action="{{ route('login.attempt') }}">
        @csrf
        <div class="brand">
            <i class="fas fa-link brand-icon" aria-hidden="true"></i>
            <div class="brand-title">AJJ CRISBER Engineering Services</div>
        </div>
        <div class="welcome">Welcome back</div>
        <div class="welcome-sub">Enter your credentials to access your account</div>
        <div class="field">
            <label for="email">Email</label>
            <div class="input-group">
                <i class="fa-regular fa-envelope input-icon" aria-hidden="true"></i>
                <input class="input" id="email" name="email" type="email" placeholder="engineer@company.com" value="{{ old('email') }}" required autofocus />
            </div>
        </div>
        <div class="field">
            <label for="password">Password</label>
            <div class="input-group">
                <i class="fa-solid fa-lock input-icon" aria-hidden="true"></i>
                <input class="input" id="password" name="password" type="password" placeholder="••••••••" required />
            </div>
        </div>
        @if ($errors->any())
            <div role="alert" class="error-summary">
                <strong>There were problems with your input.</strong>
            </div>
        @endif
        <button class="btn" type="submit">Sign In</button>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <div class="help-section">
            <div class="help-item">
                <a href="{{ route('support.forgot-password') }}" title="Reset your password">
                    <i class="fas fa-key" style="font-size: 11px;"></i>
                    Forgot Password?
                </a>
            </div>
            <div class="help-item">
                <a href="{{ route('support.form') }}" title="Contact support">
                    <i class="fas fa-headset" style="font-size: 11px;"></i>
                    Contact Support
                </a>
            </div>
        </div>

        <div class="footer">Don't have an account? <a class="link" href="mailto:admin@ajjcrisber.com?subject=Access%20request&body=Please%20provision%20an%20account%20for%20me." title="Contact your administrator">Contact your administrator</a></div>
    </form>
    </section>
</div>
</body>
</html>
