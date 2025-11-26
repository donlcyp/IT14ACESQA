<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Project Budget Management</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    :root {
      --accent: #16a34a;
      --success: #16a34a;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-500: #6b7280;
      --gray-700: #374151;
      --white: #ffffff;
    }
    
    body { 
      font-family: "Inter", sans-serif; 
      padding: 24px; 
      background-color: #f9fafb;
    }
    
    .container { max-width: 1100px; margin: 0 auto; }
    .card { 
      background: var(--white); 
      border: 1px solid var(--gray-200); 
      border-radius: 12px; 
      padding: 20px; 
      margin-bottom: 20px; 
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
    
    input { 
      padding: 10px 12px; 
      border: 1px solid var(--gray-300); 
      border-radius: 8px;
      font-family: "Inter", sans-serif;
      font-size: 14px;
    }
    
    button, .btn-success { 
      background: var(--success); 
      color: var(--white); 
      border: none; 
      cursor: pointer;
      padding: 10px 16px;
      border-radius: 8px;
      font-family: "Inter", sans-serif;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    
    button:hover, .btn-success:hover {
      background: #15803d;
      transform: translateY(-1px);
    }
    
    table { width: 100%; border-collapse: collapse; }
    th, td { 
      padding: 12px; 
      border-bottom: 1px solid var(--gray-200); 
      text-align: left;
      font-family: "Inter", sans-serif;
    }
    th { 
      background: var(--gray-100); 
      font-weight: 600; 
      color: var(--gray-700);
    }
    
    .muted { color: var(--gray-500); }
    
    label {
      font-family: "Inter", sans-serif;
      font-size: 13px;
      font-weight: 500;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Project Budget Management ({{ $currentYear }})</h1>

    <div class="card">
      <h3>Summary</h3>
      <p>Total Revenue: ₱{{ number_format($summary['total_revenue'], 2) }}</p>
      <p>Total Expenses: ₱{{ number_format($summary['total_expenses'], 2) }}</p>
      <p><strong>Net: ₱{{ number_format($summary['net'], 2) }}</strong></p>
    </div>

    <div class="card">
      <form method="post" action="{{ route('finance.budget.store') }}">
        @csrf
        <input type="hidden" name="year" value="{{ $currentYear }}" />
        <div class="grid">
          @for ($m=1;$m<=12;$m++)
            @php $val = $budgets[$m] ?? 0; @endphp
            <div>
              <label class="muted">{{ DateTime::createFromFormat('!m', $m)->format('F') }} Target (₱)</label>
              <input type="number" name="monthly[{{ $m }}]" step="0.01" min="0" value="{{ $val }}" />
            </div>
          @endfor
        </div>
        <div style="margin-top:12px">
          <button type="submit"><i class="fa fa-save"></i> Save Budget Targets</button>
        </div>
      </form>
    </div>

    <p><a href="{{ route('finance.index') }}">← Back to Finance</a></p>
  </div>
</body>
</html>
