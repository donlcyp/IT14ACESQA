<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Expense Tracking</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    :root {
      --accent: #16a34a;
      --success: #16a34a;
      --danger: #dc2626;
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
    
    .container { max-width: 1000px; margin: 0 auto; }
    .card { 
      background: var(--white); 
      border: 1px solid var(--gray-200); 
      border-radius: 12px; 
      padding: 20px; 
      margin-bottom: 20px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; }
    
    input, select { 
      padding: 10px 12px; 
      border: 1px solid var(--gray-300); 
      border-radius: 8px;
      font-family: "Inter", sans-serif;
      font-size: 14px;
    }
    
    /* Changed from red to green for consistency */
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
  </style>
</head>
<body>
  <div class="container">
    <h1>Expense Tracking ({{ $currentYear }})</h1>

    <div class="card">
      <form method="post" action="{{ route('finance.store') }}">
        @csrf
        <div class="row">
          <select name="month" required>
            <option value="">Month</option>
            @for ($m=1;$m<=12;$m++)
              <option value="{{ $m }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
            @endfor
          </select>
          <input type="number" step="0.01" min="0" name="expenses" placeholder="Expenses (₱)" required />
          <input type="hidden" name="year" value="{{ $currentYear }}" />
          <input type="hidden" name="revenue" value="0" />
          <button type="submit"><i class="fa fa-save"></i> Save Expense</button>
        </div>
      </form>
    </div>

    <div class="card">
      <table>
        <thead>
          <tr><th>Month</th><th>Expenses</th></tr>
        </thead>
        <tbody>
          @forelse ($items as $row)
            <tr>
              <td>{{ DateTime::createFromFormat('!m', $row->month)->format('F') }}</td>
              <td>₱{{ number_format($row->expenses, 2) }}</td>
            </tr>
          @empty
            <tr><td colspan="2">No records yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <p><a href="{{ route('finance') }}">← Back to Finance</a></p>
  </div>
</body>
</html>
