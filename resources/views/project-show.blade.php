<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Project • {{ $project->project_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        :root { --accent:#16a34a; --header:#16a34a; --text:#111827; --muted:#6b7280; --panel:#eef2f7; --card:#ffffff; --ring:rgba(22,163,74,.12); }
        *{box-sizing:border-box; margin:0; padding:0; -webkit-font-smoothing:antialiased}
        body{font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial; color:var(--text); background:linear-gradient(135deg,#f7fafc,#edf2f7)}
        .main{min-height:100vh; display:flex}
        .content{flex:1; display:flex; flex-direction:column}
        .header{background:linear-gradient(135deg,var(--header),#16a34a); padding:18px 24px; color:#fff; display:flex; align-items:center; gap:14px; box-shadow:0 2px 4px rgba(0,0,0,.06)}
        .header h1{font-family:"Zen Dots",sans-serif; font-size:22px; font-weight:400}
        .page{padding:24px}
        .breadcrumb{font-size:14px; color:var(--muted); margin-bottom:16px}
        .breadcrumb a{color:var(--accent); text-decoration:none}
        .top-card{background:#f3f4f6; border-radius:12px; padding:16px; display:flex; align-items:flex-start; gap:16px; justify-content:space-between; box-shadow:0 3px 6px rgba(0,0,0,.08)}
        .title-wrap{display:flex; flex-direction:column; gap:6px}
        .proj-title{font-size:22px; font-weight:700; color:#0f172a}
        .sub{color:#111827; font-size:13px}
        .status-wrap{display:flex; gap:12px; align-items:center}
        .select{min-width:180px; border:1px solid #d1d5db; border-radius:8px; padding:10px 12px; background:#fff; font-size:14px; color:#111827}
        .btn{border:1px solid #d1d5db; background:#fff; color:#374151; padding:8px 12px; border-radius:8px; display:inline-flex; align-items:center; gap:8px; cursor:pointer}
        .btn.primary{background:var(--accent); color:#fff; border-color:var(--accent)}
        .section{margin-top:18px; background:#cbd5e1; background:linear-gradient(180deg,#cbd5e1,#c7cfd9); border-radius:12px; padding:12px}
        .card{background:#e5e7eb; border-radius:10px; padding:14px}
        .fieldset{background:#f1f5f9; border-radius:12px; padding:16px; box-shadow:inset 0 1px 0 rgba(255,255,255,.6)}
        .legend{font-weight:800; color:#1f2937; font-size:18px; margin-bottom:12px}
        .grid{display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:14px}
        .grid-2{display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px}
        .form-group{display:flex; flex-direction:column; gap:6px}
        .label{font-size:12px; color:#111827}
        .input,.textarea{background:#fff; border:1px solid #d1d5db; border-radius:8px; padding:10px 12px; font-size:14px; color:#111827}
        .input:focus,.textarea:focus,.select:focus{outline:none; border-color:var(--accent); box-shadow:0 0 0 3px var(--ring)}
        .textarea{min-height:130px; resize:vertical}
        .muted{color:#dc2626; font-size:11px; margin-bottom:6px}
        .pill{display:inline-flex; align-items:center; gap:8px; background:#fff; border:1px solid #d1d5db; padding:8px 12px; border-radius:10px}
        @media (max-width:1100px){ .grid{grid-template-columns:repeat(2,minmax(0,1fr));} }
        @media (max-width:640px){ .grid,.grid-2{grid-template-columns:1fr;} .top-card{flex-direction:column; align-items:stretch} }
    </style>
</head>
<body>
<div class="main">
    @include('partials.sidebar')
    <div class="content" id="mainContent">
        <div class="header">
            <button class="btn" id="headerMenu"><i class="fas fa-bars"></i></button>
            <h1>AJJ CRISBER Engineering Services</h1>
        </div>
        <div class="page">
            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <span> ></span>
                <a href="{{ route('projects') }}">Projects</a>
                <span> ></span>
                <span>{{ $project->project_name }}</span>
            </div>

            <div class="top-card">
                <div class="title-wrap">
                    <div class="proj-title">{{ $project->project_name }}</div>
                    <div class="sub">{{ $project->client_full_name ?: $project->client_name ?: 'Client' }}</div>
                </div>
                <div class="status-wrap">
                    <div class="pill">
                        <span style="min-width:110px; color:#6b7280">Project Status</span>
                        <select class="select" disabled>
                            @php $statuses=['Under Review','Mobilizing','On Hold','Ongoing','Completed']; @endphp
                            @foreach($statuses as $s)
                                <option value="{{ $s }}" {{ $project->status===$s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pill">
                        <span style="min-width:110px; color:#6b7280">QA Status</span>
                        <select class="select" disabled>
                            <option>—</option>
                        </select>
                    </div>
                    <button class="btn primary"><i class="fas fa-pen"></i><span>Edit</span></button>
                </div>
            </div>

            <div class="section">
                <div class="card">
                    <div class="fieldset">
                        <div class="legend">Project Details</div>
                        <div class="muted">Fields marked (•) are required</div>
                        <div class="grid">
                            <div class="form-group">
                                <label class="label">Project ID •</label>
                                <input class="input" value="P{{ str_pad($project->id,3,'0',STR_PAD_LEFT) }}" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Location •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Category •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Target Timeline •</label>
                                <input class="input" type="date" value="" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Project Manager ID •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Project Manager •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Industry •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Date Started</label>
                                <input class="input" type="date" value="" readonly />
                            </div>
                        </div>
                        <div class="grid-2" style="margin-top:8px">
                            <div class="form-group">
                                <label class="label">Required Materials</label>
                                <textarea class="textarea" placeholder="—" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label class="label">Notes/Remarks</label>
                                <textarea class="textarea" placeholder="—" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="card">
                    <div class="fieldset">
                        <div class="legend">Client Information</div>
                        <div class="muted">Fields marked (•) are required</div>
                        <div class="grid">
                            <div class="form-group">
                                <label class="label">Client ID •</label>
                                <input class="input" value="C{{ str_pad($project->id,4,'0',STR_PAD_LEFT) }}" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Client Name •</label>
                                <input class="input" value="{{ $project->client_full_name }}" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Company Name</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Age •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Gender •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Date of Birth •</label>
                                <input class="input" type="date" value="" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Profession</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Email Address •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Phone Number •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Contact Person •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="card">
                    <div class="fieldset">
                        <div class="legend">Address Details</div>
                        <div class="muted">Fields marked (•) are required</div>
                        <div class="grid">
                            <div class="form-group">
                                <label class="label">Address Line 1 •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Address Line 2</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">City / Municipality •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Province / State •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">ZIP / Postal Code •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                            <div class="form-group">
                                <label class="label">Country •</label>
                                <input class="input" value="" placeholder="—" readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.sidebar-js')
</body>
</html>
