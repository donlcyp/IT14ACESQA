<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Purchase Orders</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    :root {
      --accent: #16a34a;
      --danger: #dc2626;
      --success: #16a34a;
      --warning: #f59e0b;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-500: #6b7280;
      --gray-700: #374151;
      --gray-800: #1f2937;
      --white: #ffffff;
    }
    
    body { 
      font-family: "Inter", sans-serif; 
      padding: 24px; 
      background-color: #f9fafb;
    }
    
    .container { max-width: 1100px; margin: 0 auto; }
    .card { background: var(--white); border: 1px solid var(--gray-200); border-radius: 12px; padding: 20px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); }
    .row { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; }
    
    input, select { 
      padding: 10px 12px; 
      border: 1px solid var(--gray-300); 
      border-radius: 8px; 
      font-family: "Inter", sans-serif;
      font-size: 14px;
    }
    
    /* Standardized Button Styles */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 10px 16px;
      border: none;
      border-radius: 8px;
      font-family: "Inter", sans-serif;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
    }
    
    .btn-success, .btn-add, .btn-new, .btn-edit {
      background: var(--success);
      color: var(--white);
    }
    
    .btn-success:hover, .btn-add:hover, .btn-new:hover, .btn-edit:hover {
      background: #15803d;
      transform: translateY(-1px);
    }
    
    .btn-danger, .btn-delete {
      background: var(--danger);
      color: var(--white);
    }
    
    .btn-danger:hover, .btn-delete:hover {
      background: #b91c1c;
      transform: translateY(-1px);
    }
    
    .btn-warning {
      background: var(--warning);
      color: var(--white);
    }
    
    .btn-warning:hover {
      background: #d97706;
      transform: translateY(-1px);
    }
    
    .btn-secondary {
      background: var(--gray-100);
      color: var(--gray-700);
      border: 1px solid var(--gray-300);
    }
    
    .btn-secondary:hover {
      background: var(--gray-200);
    }
    
    /* Legacy button support */
    button { 
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
    }
    
    button:hover {
      background: #15803d;
      transform: translateY(-1px);
    }
    
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 12px; border-bottom: 1px solid var(--gray-200); text-align: left; font-family: "Inter", sans-serif; }
    th { background: var(--gray-100); font-weight: 600; color: var(--gray-700); }
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
              <td>{{ $o->id }}</td>
              <td>{{ $o->supplier }}</td>
              <td>{{ $o->item }}</td>
              <td>{{ $o->quantity }}</td>
              <td>₱{{ number_format($o->unit_price, 2) }}</td>
              <td>{{ $o->status }}</td>
              <td>
                <form class="inline" method="post" action="{{ route('finance.purchase-orders.status', $o->id) }}">
                  @csrf
                  <select name="status">
                    @foreach (['Pending','Approved','Rejected','Received'] as $s)
                      <option value="{{ $s }}" {{ $s===$o->status?'selected':'' }}>{{ $s }}</option>
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
      @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator && $orders->hasPages())
        @php
          $currentPage = $orders->currentPage();
          $lastPage = $orders->lastPage();
          $pageNumbers = [];
          if ($lastPage <= 7) {
            for ($i = 1; $i <= $lastPage; $i++) {
              $pageNumbers[] = $i;
            }
          } else {
            $pageNumbers[] = 1;
            if ($currentPage > 3) {
              $pageNumbers[] = '...';
            }
            $start = max(2, $currentPage - 1);
            $end = min($lastPage - 1, $currentPage + 1);
            for ($i = $start; $i <= $end; $i++) {
              $pageNumbers[] = $i;
            }
            if ($currentPage < $lastPage - 2) {
              $pageNumbers[] = '...';
            }
            $pageNumbers[] = $lastPage;
          }
        @endphp
        <div class="pagination-container" style="display: flex; flex-direction: column; align-items: center; gap: 16px; padding: 20px 0;">
          <div class="pagination-info" style="color: #6b7280; font-size: 14px; text-align: center;">
            Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} purchase orders
          </div>
          <div class="pagination-controls" style="display: flex; align-items: center; justify-content: center; gap: 12px;">
            @if ($orders->onFirstPage())
              <span class="page-btn arrow disabled" style="opacity: 0.5; color: #9ca3af; cursor: not-allowed; pointer-events: none; text-decoration: none; font-size: 20px;">‹</span>
            @else
              <a class="page-btn arrow" href="{{ $orders->previousPageUrl() }}" rel="prev" style="color: #374151; text-decoration: underline; font-size: 20px;">‹</a>
            @endif
            <div class="pagination-nav" style="display: flex; align-items: center; justify-content: center; gap: 4px;">
              @foreach ($pageNumbers as $page)
                @if ($page === '...')
                  <span class="page-btn ellipsis">…</span>
                @elseif ($page == $currentPage)
                  <span class="page-btn active" style="background: #16a34a; color: white; font-weight: 600; text-decoration: none; border-radius: 8px; padding: 0 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">{{ $page }}</span>
                @else
                  <a class="page-btn" href="{{ $orders->url($page) }}">{{ $page }}</a>
                @endif
              @endforeach
            </div>
            @if ($orders->hasMorePages())
              <a class="page-btn arrow" href="{{ $orders->nextPageUrl() }}" rel="next">›</a>
            @else
              <span class="page-btn arrow disabled">›</span>
            @endif
          </div>
        </div>
      @endif
    </div>

    <p><a href="{{ route('finance') }}">← Back to Finance</a></p>
  </div>
</body>
</html>
