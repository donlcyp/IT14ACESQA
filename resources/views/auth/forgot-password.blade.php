<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Forgot Password - AJJ CRISBER Engineering Services</title>
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
        .back-link{display:flex; align-items:center; gap:6px; font-size:13px; color:#2563eb; text-decoration:none; margin-bottom:16px}
        .back-link:hover{text-decoration:underline}
        .title{font-weight:700; font-size:22px; color:var(--gray-900); margin:0 0 8px}
        .subtitle{font-size:14px; color:var(--gray-600); margin:0 0 20px; line-height:1.5}
        .field{display:flex; flex-direction:column; gap:6px; margin-bottom:14px}
        label{font-size:13px; color:var(--gray-600)}
        .input-group{position:relative}
        .input-icon{position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#94a3b8}
        .input, textarea{padding:10px 12px 10px 36px; border:1px solid var(--gray-300); border-radius:10px; outline:none; background:#eef2f7; width:100%; transition:border-color .2s, box-shadow .2s; font-family:Inter, system-ui;}
        .input{height:44px}
        textarea{resize:vertical; min-height:100px; padding:10px 12px}
        .input:focus, textarea:focus{border-color:var(--accent); box-shadow:0 0 0 3px rgba(22,163,74,.12)}
        .btn{width:100%; height:46px; border-radius:10px; border:1px solid var(--btn-dark); background:var(--btn-dark); color:#fff; font-weight:700; cursor:pointer; box-shadow:0 6px 14px rgba(2,6,23,.18);}
        .btn:hover{filter:brightness(0.9)}
        .success-message{margin:10px 0; padding:12px 14px; border:1px solid #86efac; background:#dcfce7; color:#166534; border-radius:8px; font-size:13px}
        .error-message{margin:10px 0; padding:12px 14px; border:1px solid #fecaca; background:#fef2f2; color:#991b1b; border-radius:8px; font-size:13px}
        .info-box{margin:16px 0; padding:12px 14px; border:1px solid #bfdbfe; background:#eff6ff; color:#1e40af; border-radius:8px; font-size:13px; line-height:1.5}
        .divider{margin:20px 0; text-align:center; font-size:13px; color:var(--gray-600)}
        .divider-line{border:none; border-top:1px solid var(--gray-300)}
        .divider-text{display:inline-block; background:var(--white); padding:0 8px; position:relative; top:-10px}
        .footer{margin-top:14px; text-align:center; font-size:12px; color:var(--gray-600)}
        .aux{display:flex; align-items:center; justify-content:space-between; margin-top:6px}
        .link{font-size:12px; color:#2563eb; text-decoration:none}
        .link:hover{text-decoration:underline}
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
    <form class="card" method="POST" action="{{ route('support.forgot-password') }}">
        @csrf
        <a href="{{ route('login') }}" class="back-link">
            <i class="fas fa-arrow-left" style="font-size: 12px;"></i>
            Back to Login
        </a>

        <h1 class="title">Forgot Password?</h1>
        <p class="subtitle">No worries! Enter your email address and we'll help you recover your account.</p>

        @if ($errors->any())
            <div class="error-message">
                <strong>There were problems with your input.</strong>
            </div>
        @endif

        @if (session('success'))
            <div class="success-message">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="error-message">
                <strong>Error!</strong> {{ session('error') }}
            </div>
        @endif

        <div class="field">
            <label for="email">Email Address *</label>
            <div class="input-group">
                <i class="fa-regular fa-envelope input-icon" aria-hidden="true"></i>
                <input class="input" id="email" name="email" type="email" placeholder="engineer@company.com" value="{{ old('email') }}" required autofocus />
            </div>
            @error('email')
                <small style="color: #991b1b;">{{ $message }}</small>
            @enderror
        </div>

        <div class="field">
            <label for="reason">Reason (Optional)</label>
            <textarea id="reason" name="reason" placeholder="Tell us why you forgot your password or any additional context..." style="margin-left: 0; padding: 10px 12px;">{{ old('reason') }}</textarea>
            @error('reason')
                <small style="color: #991b1b;">{{ $message }}</small>
            @enderror
        </div>

        <div class="info-box">
            <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
            An administrator will verify your identity and send your password to your email address.
        </div>

        <button class="btn" type="submit">Submit Reset Request</button>

        <div class="divider">
            <div style="border-top: 1px solid var(--gray-300);"></div>
            <span style="display: inline-block; background: var(--white); padding: 0 8px; position: relative; top: -10px;">or</span>
        </div>

        <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--gray-300);">
            <p style="font-size: 13px; color: var(--gray-600); margin: 0 0 8px;">Need other help?</p>
            <a href="{{ route('support.form') }}" style="font-size: 13px; color: #2563eb; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                <i class="fas fa-headset"></i>
                Contact Support
            </a>
        </div>

        <div class="footer">
            Remember your password? <a class="link" href="{{ route('login') }}">Sign in here</a>
        </div>
    </form>
    </section>
</div>
</body>
</html>
