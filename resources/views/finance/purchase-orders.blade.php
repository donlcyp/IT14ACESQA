<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Purchase Orders</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    body { font-family: Inter, system-ui, Arial; padding: 24px; }
    .container { max-width: 1100px; margin: 0 auto; }
    .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; margin-bottom: 20px; }
    .row { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; }
    input, select, button { padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; }
    button { background: #16a34a; color: #fff; border: none; cursor: pointer; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; }
    form.inline { display: inline-block; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Purchase Orders</h1>

    <div class="card">
      <form method="post" action="{{ route('finance.purchase-orders.store') }}">
        @csrf
        <div class="row">
          <input type="text" name="supplier" placeholder="Supplier" required />
          <input type="text" name="item" placeholder="Item" required />
          <input type="number" name="quantity" min="1" placeholder="Qty" required />
          <input type="number" step="0.01" name="unit_price" min="0" placeholder="Unit Price (₱)" required />
          <button type="submit"><i class="fa fa-plus"></i> Add PO</button>
        </div>
      </form>
    </div>

    <div class="card">
      <table>
        <thead>
          <tr><th>ID</th><th>Supplier</th><th>Item</th><th>Qty</th><th>Unit Price</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
          @forelse ($orders as $o)
            <tr>
              <td>{{ $o['id'] }}</td>
              <td>{{ $o['supplier'] }}</td>
              <td>{{ $o['item'] }}</td>
              <td>{{ $o['quantity'] }}</td>
              <td>₱{{ number_format($o['unit_price'], 2) }}</td>
              <td>{{ $o['status'] }}</td>
              <td>
                <form class="inline" method="post" action="{{ route('finance.purchase-orders.status', $o['id']) }}">
                  @csrf
                  <select name="status">
                    @foreach (['Pending','Approved','Rejected','Received'] as $s)
                      <option value="{{ $s }}" {{ $s===$o['status']?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                  </select>
                  <button type="submit">Update</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="7">No purchase orders yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <p><a href="{{ route('finance') }}">← Back to Finance</a></p>
  </div>
</body>
</html>
