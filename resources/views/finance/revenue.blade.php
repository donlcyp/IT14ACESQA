<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Revenue Recording</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    body { font-family: Inter, system-ui, Arial; padding: 24px; }
    .container { max-width: 1000px; margin: 0 auto; }
    .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; margin-bottom: 20px; }
    .row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; }
    input, select, button { padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; }
    button { background: #16a34a; color: #fff; border: none; cursor: pointer; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Revenue Recording ({{ $currentYear }})</h1>

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
          <input type="number" step="0.01" min="0" name="revenue" placeholder="Revenue (₱)" required />
          <input type="hidden" name="year" value="{{ $currentYear }}" />
          <input type="hidden" name="expenses" value="0" />
          <button type="submit"><i class="fa fa-save"></i> Save Revenue</button>
        </div>
      </form>
    </div>

    <div class="card">
      <table>
        <thead>
          <tr><th>Month</th><th>Revenue</th></tr>
        </thead>
        <tbody>
          @forelse ($items as $row)
            <tr>
              <td>{{ DateTime::createFromFormat('!m', $row->month)->format('F') }}</td>
              <td>₱{{ number_format($row->revenue, 2) }}</td>
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
