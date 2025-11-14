<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Project Budget Management</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    body { font-family: Inter, system-ui, Arial; padding: 24px; }
    .container { max-width: 1100px; margin: 0 auto; }
    .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; margin-bottom: 20px; }
    .grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
    input, button { padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; }
    button { background: #16a34a; color: #fff; border: none; cursor: pointer; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; }
    .muted { color: #6b7280; }
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

    <p><a href="{{ route('finance') }}">← Back to Finance</a></p>
  </div>
</body>
</html>
