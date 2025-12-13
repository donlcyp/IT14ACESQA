<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Support Ticket - AJJ CRISBER Engineering Services</title>
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
        .panel{display:flex; align-items:center; justify-content:center; padding:24px; max-height:100vh; overflow-y:auto}
        .card{
            width:100%; max-width:520px; background:var(--white); border:1px solid var(--gray-300);
            border-radius:16px; box-shadow: 0 20px 40px rgba(2, 6, 23, 0.08);
            padding:28px 28px 22px;
        }
        .back-link{display:flex; align-items:center; gap:6px; font-size:13px; color:#2563eb; text-decoration:none; margin-bottom:16px}
        .back-link:hover{text-decoration:underline}
        .title{font-weight:700; font-size:22px; color:var(--gray-900); margin:0 0 8px}
        .subtitle{font-size:14px; color:var(--gray-600); margin:0 0 20px; line-height:1.5}
        .field{display:flex; flex-direction:column; gap:6px; margin-bottom:14px}
        label{font-size:13px; color:var(--gray-600); font-weight:500}
        .input-group{position:relative}
        .input-icon{position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:14px}
        .input, textarea, select{
            padding:10px 12px 10px 36px; border:1px solid var(--gray-300); border-radius:10px; outline:none; 
            background:#eef2f7; width:100%; transition:border-color .2s, box-shadow .2s; 
            font-family:Inter, system-ui; font-size:14px;
        }
        .input{height:44px}
        textarea{resize:vertical; min-height:120px; padding:10px 12px}
        select{padding-left:12px}
        .input:focus, textarea:focus, select:focus{border-color:var(--accent); box-shadow:0 0 0 3px rgba(22,163,74,.12)}
        .row{display:grid; grid-template-columns:1fr 1fr; gap:14px}
        .row.full{grid-template-columns:1fr}
        .required{color:#dc2626}
        .btn{width:100%; height:46px; border-radius:10px; border:1px solid var(--btn-dark); background:var(--btn-dark); color:#fff; font-weight:700; cursor:pointer; box-shadow:0 6px 14px rgba(2,6,23,.18);}
        .btn:hover{background:var(--btn-dark-hover)}
        .success-message{margin:10px 0; padding:12px 14px; border:1px solid #86efac; background:#dcfce7; color:#166534; border-radius:8px; font-size:13px}
        .error-message{margin:10px 0; padding:12px 14px; border:1px solid #fecaca; background:#fef2f2; color:#991b1b; border-radius:8px; font-size:13px}
        .info-box{margin:16px 0; padding:12px 14px; border:1px solid #bfdbfe; background:#eff6ff; color:#1e40af; border-radius:8px; font-size:13px; line-height:1.5}
        .footer{margin-top:14px; text-align:center; font-size:12px; color:var(--gray-600)}
        .link{font-size:12px; color:#2563eb; text-decoration:none}
        .link:hover{text-decoration:underline}
        .small-text{font-size:12px; color:var(--gray-600)}
        @media (max-width: 960px){ 
            .container{grid-template-columns:1fr;} 
            .hero{display:none;} 
            .row{grid-template-columns:1fr}
        }
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
    <form class="card" method="POST" action="{{ route('support.submit-ticket') }}">
        @csrf
        <a href="{{ route('login') }}" class="back-link">
            <i class="fas fa-arrow-left" style="font-size: 12px;"></i>
            Back to Login
        </a>

        <h1 class="title">Contact Support</h1>
        <p class="subtitle">Tell us about your concern and we'll get back to you as soon as possible.</p>

        @if ($errors->any())
            <div class="error-message">
                <strong>Please fix the errors below.</strong>
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

        <div class="row">
            <div class="field">
                <label for="name">Full Name <span class="required">*</span></label>
                <div class="input-group">
                    <i class="fas fa-user input-icon"></i>
                    <input class="input" id="name" name="name" type="text" placeholder="Your full name" value="{{ old('name', auth()->user()?->name ?? '') }}" required />
                </div>
                @error('name')
                    <small style="color: #991b1b;">{{ $message }}</small>
                @enderror
            </div>

            <div class="field">
                <label for="email">Email Address <span class="required">*</span></label>
                <div class="input-group">
                    <i class="fa-regular fa-envelope input-icon"></i>
                    <input class="input" id="email" name="email" type="email" placeholder="your@email.com" value="{{ old('email', auth()->user()?->email ?? '') }}" required />
                </div>
                @error('email')
                    <small style="color: #991b1b;">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="field">
            <label for="gmail_account">Gmail Account (Optional)</label>
            <div class="input-group">
                <i class="fab fa-google input-icon"></i>
                <input class="input" id="gmail_account" name="gmail_account" type="email" placeholder="your.gmail@gmail.com" value="{{ old('gmail_account') }}" />
            </div>
            <small class="small-text">We'll contact you at this address if provided</small>
            @error('gmail_account')
                <small style="color: #991b1b;">{{ $message }}</small>
            @enderror
        </div>

        <div class="field">
            <label for="subject">Subject <span class="required">*</span></label>
            <div class="input-group">
                <i class="fas fa-heading input-icon"></i>
                <input class="input" id="subject" name="subject" type="text" placeholder="Brief subject of your concern" value="{{ old('subject') }}" required />
            </div>
            @error('subject')
                <small style="color: #991b1b;">{{ $message }}</small>
            @enderror
        </div>

        <div class="row">
            <div class="field">
                <label for="category">Category <span class="required">*</span></label>
                <div class="input-group">
                    <i class="fas fa-list input-icon"></i>
                    <select id="category" name="category" required>
                        <option value="">-- Select a category --</option>
                        <option value="password_reset" {{ old('category') == 'password_reset' ? 'selected' : '' }}>
                            <i class="fas fa-key"></i> Password Reset
                        </option>
                        <option value="account_issue" {{ old('category') == 'account_issue' ? 'selected' : '' }}>
                            <i class="fas fa-user-circle"></i> Account Issue
                        </option>
                        <option value="technical_issue" {{ old('category') == 'technical_issue' ? 'selected' : '' }}>
                            <i class="fas fa-wrench"></i> Technical Issue
                        </option>
                        <option value="feature_request" {{ old('category') == 'feature_request' ? 'selected' : '' }}>
                            <i class="fas fa-lightbulb"></i> Feature Request
                        </option>
                        <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>
                            <i class="fas fa-question-circle"></i> Other
                        </option>
                    </select>
                </div>
                @error('category')
                    <small style="color: #991b1b;">{{ $message }}</small>
                @enderror
            </div>

            <div class="field">
                <label for="priority">Priority <span class="required">*</span></label>
                <div class="input-group">
                    <i class="fas fa-flag input-icon"></i>
                    <select id="priority" name="priority" required>
                        <option value="">-- Select priority --</option>
                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }} selected>Medium</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                </div>
                @error('priority')
                    <small style="color: #991b1b;">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="field">
            <label for="concern">Concern / Description <span class="required">*</span></label>
            <textarea id="concern" name="concern" placeholder="Describe your issue or concern in detail..." required>{{ old('concern') }}</textarea>
            <small class="small-text">{{ 2000 - strlen(old('concern', '')) }} characters remaining</small>
            @error('concern')
                <small style="color: #991b1b;">{{ $message }}</small>
            @enderror
        </div>

        <div class="info-box">
            <i class="fas fa-envelope" style="margin-right: 8px;"></i>
            We'll send a confirmation email to your address. Our support team will review and respond shortly.
        </div>

        <button class="btn" type="submit">Submit Support Ticket</button>

        <div class="footer">
            Need to reset your password? <a class="link" href="{{ route('support.forgot-password') }}">Click here</a>
        </div>
    </form>
    </section>
</div>

<script>
    // Character counter
    const concernInput = document.getElementById('concern');
    const counter = concernInput.parentElement.querySelector('.small-text');
    
    concernInput.addEventListener('input', function() {
        const remaining = 2000 - this.value.length;
        counter.textContent = remaining + ' characters remaining';
    });
</script>
</body>
</html>
