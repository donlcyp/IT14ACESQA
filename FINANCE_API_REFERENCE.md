# Finance & Transaction Modules - API Reference

## Quick Access Guide

### Navigation Links
```blade
<!-- Finance Dashboard -->
<a href="{{ route('finance.index') }}">Finance Dashboard</a>

<!-- Supplier Invoices -->
<a href="{{ route('finance.supplier-invoices') }}">Supplier Invoices</a>

<!-- Payment Summary -->
<a href="{{ route('finance.payment-summary') }}">Payment Summary</a>

<!-- Transactions -->
<a href="{{ route('transactions.index') }}">Transactions</a>

<!-- Transaction Details -->
<a href="{{ route('transactions.show', $projectId) }}">Transaction Details</a>

<!-- Supplier Invoice -->
<a href="{{ route('transactions.invoice', ['projectId' => $projectId, 'supplier' => $supplier]) }}">Supplier Invoice</a>

<!-- Transaction History -->
<a href="{{ route('transactions.history') }}">Transaction History</a>
```

---

## API Endpoints

### Finance Module

#### 1. Finance Dashboard
**Route:** `GET /finance`  
**Name:** `finance.index`  
**Controller:** `FinanceController@index`  
**Required Role:** OWNER or FM  
**Purpose:** Main finance dashboard with expense summary

**Data Available in View:**
```php
$materials          // Collection of all materials
$totalExpenses      // decimal - sum of all material costs
$approvedExpenses   // decimal - sum of approved material costs
$pendingExpenses    // decimal - sum of pending material costs
$failedExpenses     // decimal - sum of failed material costs
$projectCosts       // Collection of projects with cost breakdown
```

**Response View:** `finance/index.blade.php`

---

#### 2. Supplier Invoices
**Route:** `GET /finance/supplier-invoices`  
**Name:** `finance.supplier-invoices`  
**Controller:** `FinanceController@supplierInvoices`  
**Required Role:** OWNER or FM  
**Purpose:** View and filter supplier invoices

**Data Available in View:**
```php
$materials              // Collection of all materials
$suppliers              // Collection of unique suppliers
$totalInvoiceAmount     // decimal - total of all invoices
$paidAmount             // decimal - sum of approved invoices
$unpaidAmount           // decimal - sum of pending/failed invoices
```

**Response View:** `finance/supplier-invoices.blade.php`

**JavaScript Functions:**
- `filterTable()` - Filter by supplier and payment status

---

#### 3. Payment Summary
**Route:** `GET /finance/payment-summary`  
**Name:** `finance.payment-summary`  
**Controller:** `FinanceController@paymentSummary`  
**Required Role:** OWNER or FM  
**Purpose:** Payment tracking and outstanding balance report

**Data Available in View:**
```php
$materials          // Collection of all materials
$unpaidMaterials    // Collection of unpaid materials
$totalAmount        // decimal - total of all amounts
$paidAmount         // decimal - sum of paid amounts
$unpaidAmount       // decimal - sum of unpaid amounts
```

**Response View:** `finance/payment-summary.blade.php`

**Calculated Fields:**
- Payment completion percentage
- Days pending for each unpaid item
- Outstanding balance tracking

---

### Transaction Module

#### 1. Transaction List
**Route:** `GET /transactions`  
**Name:** `transactions.index`  
**Controller:** `TransactionController@index`  
**Required Role:** OWNER or FM  
**Purpose:** View all project transactions

**Data Available in View:**
```php
$projects           // Collection of ProjectRecords with materials
// Each ProjectRecord includes:
// - materials          - related materials
// - failed_count       - count of failed materials
// - suppliers          - array of unique suppliers
```

**Response View:** `transactions/index.blade.php`

---

#### 2. Transaction Details
**Route:** `GET /transactions/{id}`  
**Name:** `transactions.show`  
**Parameters:**
- `id` (integer) - ProjectRecord ID or Project ID

**Controller:** `TransactionController@show`  
**Required Role:** OWNER or FM  
**Purpose:** View detailed transaction for specific project

**Data Available in View:**
```php
$project            // Project object
$projectRecord      // ProjectRecord object (if available)
$suppliers          // Collection of unique suppliers
$allMaterials       // Collection of materials for project
```

**Response View:** `transactions/show.blade.php`

---

#### 3. Supplier Invoice
**Route:** `GET /transactions/{projectId}/invoice/{supplier}`  
**Name:** `transactions.invoice`  
**Parameters:**
- `projectId` (integer) - ProjectRecord or Project ID
- `supplier` (string) - Supplier name

**Controller:** `TransactionController@invoice`  
**Required Role:** OWNER or FM  
**Purpose:** Generate invoice for specific supplier

**Data Available in View:**
```php
$project            // Project object
$supplier           // Supplier name (string)
$materials          // Collection of approved materials from supplier
$failedMaterials    // Collection of failed materials for return
$subtotal           // decimal - sum of approved materials
$tax                // decimal - 12% VAT on subtotal
$total              // decimal - subtotal + tax
$failedSubtotal     // decimal - sum of failed materials
$purchaseHistory    // Collection of purchase history
$projectRecord      // ProjectRecord object (if available)
```

**Response View:** `transactions/invoice.blade.php`

**Calculations:**
- Subtotal: Sum of all approved material costs
- Tax: 12% VAT on subtotal
- Total: Subtotal + Tax
- Failed Subtotal: Sum of failed materials for return tracking

---

#### 4. Transaction History
**Route:** `GET /transactions-history`  
**Name:** `transactions.history`  
**Controller:** `TransactionController@history`  
**Required Role:** OWNER or FM  
**Purpose:** View complete purchase history

**Data Available in View:**
```php
$history            // Paginated collection (20 per page)
// Each item includes:
// - id
// - material_name
// - supplier
// - quantity_received
// - unit_of_measure
// - unit_price
// - total_cost
// - status
// - date_received
// - created_at
```

**Response View:** `transactions/history.blade.php`

**Features:**
- Paginated display (20 items per page)
- Sortable by creation date
- Searchable material details

---

## Data Model Reference

### Material Model
Located: `app/Models/Material.php`

**Key Attributes:**
```php
// Identification
$material->id
$material->project_record_id        // Links to ProjectRecord
$material->project_id               // Links to Project

// Material Details
$material->material_name            // Name of material
$material->batch_serial_no          // Batch/serial tracking
$material->supplier                 // Supplier name
$material->location                 // Storage location
$material->remarks                  // Notes/return reason

// Quantities
$material->quantity_received        // Amount received (decimal)
$material->unit_of_measure          // Unit (kg, m, pcs, etc.)

// Pricing
$material->unit_price               // Price per unit (decimal:2)
$material->total_cost               // Total cost (decimal:2)

// Dates
$material->date_received            // When material was received
$material->date_inspected           // When material was inspected
$material->created_at               // Record creation date
$material->updated_at               // Record update date

// Status
$material->status                   // 'approved', 'pending', or 'failed'
```

**Relationships:**
```php
// Get associated project record
$material->projectRecord()           // ProjectRecord

// Get associated project
$material->project()                 // Project

// Get purchase orders
$material->purchaseOrders()          // Collection of PurchaseOrder
```

---

## Status Values

### Material Status
- **`approved`** - Material received, inspected, and approved for use/payment
- **`pending`** - Material awaiting inspection or approval decision
- **`failed`** - Material failed inspection, marked for return to supplier

**Payment Mapping:**
- Approved = Paid
- Pending = Unpaid
- Failed = Unpaid (marked for return/refund)

---

## Common Query Examples

### Get All Expenses
```php
$total = Material::sum('total_cost');
```

### Get Approved Expenses
```php
$approved = Material::where('status', 'approved')->sum('total_cost');
```

### Get Expenses by Supplier
```php
$supplierExpenses = Material::where('supplier', $supplier)->sum('total_cost');
```

### Get Expenses by Project
```php
$projectExpenses = Material::where('project_id', $projectId)->sum('total_cost');
```

### Get Failed/Return Materials
```php
$returns = Material::where('status', 'failed')->get();
$returnTotal = $returns->sum('total_cost');
```

### Get Materials by Date Range
```php
$materials = Material::whereBetween('date_received', [$startDate, $endDate])->get();
```

### Get Outstanding Payments
```php
$outstanding = Material::whereIn('status', ['pending', 'failed'])->get();
$outstandingAmount = $outstanding->sum('total_cost');
```

### Get Payment Completion Percentage
```php
$total = Material::sum('total_cost');
$paid = Material::where('status', 'approved')->sum('total_cost');
$percentage = $total > 0 ? ($paid / $total) * 100 : 0;
```

---

## View Components

### Stat Cards
Used in finance dashboard to display key metrics:
```blade
<div class="stat-card">
    <div class="stat-label">Label</div>
    <div class="stat-value">Value</div>
    <div class="stat-subtext">Additional info</div>
</div>
```

### Badge Status
Color-coded status indicators:
```blade
<span class="badge badge-approved">Approved</span>
<span class="badge badge-pending">Pending</span>
<span class="badge badge-paid">Paid</span>
<span class="badge badge-unpaid">Unpaid</span>
```

### Progress Bars
Visual representation of percentage completion:
```blade
<div class="progress-bar">
    <div class="progress-fill" style="width: {{ $percentage }}%"></div>
</div>
```

### Breakdown Items
Payment summary display:
```blade
<div class="breakdown-item">
    <span class="breakdown-label">Label</span>
    <span class="breakdown-value">Value</span>
</div>
```

---

## Access Control

### Protected Routes
All financial and transaction routes require authentication and role verification:

```php
// Middleware applied
Route::middleware('role:OWNER,FM')->group(function () {
    // All finance and transaction routes
});
```

**Required Roles:**
- `OWNER` - Full access
- `FM` (Financial Manager) - Full access

**Access Denied For:**
- `PM` (Project Manager)
- `QA` (Quality Assurance)
- Unauthenticated users

---

## Troubleshooting

### Issue: Routes not found
**Solution:** Run `php artisan route:cache:clear` and verify routes with `php artisan route:list | grep finance`

### Issue: Data not showing in views
**Solution:** Verify Material table has data and check controller is returning compact() with required variables

### Issue: Pagination not working
**Solution:** Ensure transaction history view includes `{{ $history->links() }}` for pagination

### Issue: Filtering not working
**Solution:** Verify JavaScript `filterTable()` function is called and HTML attributes have correct `data-*` values

### Issue: Status badges showing wrong color
**Solution:** Check CSS class matches status value (badge-approved, badge-pending, etc.)

---

## Performance Tips

1. **Eager Loading**: Queries use `with()` to load relationships efficiently
2. **Pagination**: History views use pagination to limit results
3. **Caching**: Consider caching financial reports for frequently accessed data
4. **Indexing**: Ensure foreign keys have proper database indexes

---

**Last Updated:** Current
**API Version:** 1.0
**Status:** ✅ Production Ready
