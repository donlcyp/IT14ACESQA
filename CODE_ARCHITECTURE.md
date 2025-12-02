# Code Architecture Overview

## System Architecture Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                         USER INTERFACE                          │
│                                                                 │
│  ┌──────────────────────┐  ┌──────────────────────────────────┐
│  │  Login Page          │  │  /forgot-password                │
│  │                      │──→  - Email field                   │
│  │  - Forgot Password   │     - Reason field                  │
│  │  - Contact Support   │     - Submit button                 │
│  └──────────────────────┘  └──────────────────────────────────┘
│                                         │
│                              ┌──────────┴──────────┐
│                              ↓                     ↓
│                    ┌──────────────────┐  ┌──────────────────┐
│                    │ /support         │  │ /admin/support/* │
│                    │ - Full Name      │  │ (OWNER only)     │
│                    │ - Email          │  │                  │
│                    │ - Gmail          │  │ - Manage PW      │
│                    │ - Subject        │  │   Resets         │
│                    │ - Category       │  │ - Manage Tickets │
│                    │ - Priority       │  │ - Respond        │
│                    │ - Concern        │  │ - Update Status  │
│                    └──────────────────┘  └──────────────────┘
└─────────────────────────────────────────────────────────────────┘
                             │
                             ↓
        ┌────────────────────────────────────────┐
        │         CONTROLLERS                    │
        │                                        │
        │ ┌──────────────────────────────────┐  │
        │ │ SupportController                │  │
        │ │ - showForgotPassword()           │  │
        │ │ - submitForgotPassword()         │  │
        │ │ - showSupportForm()              │  │
        │ │ - submitSupportTicket()          │  │
        │ │ - sendEmail() [private]          │  │
        │ └──────────────────────────────────┘  │
        │                                        │
        │ ┌──────────────────────────────────┐  │
        │ │ AdminSupportController           │  │
        │ │ - passwordResets()               │  │
        │ │ - showPasswordReset()            │  │
        │ │ - resolvePasswordReset()         │  │
        │ │ - rejectPasswordReset()          │  │
        │ │ - supportTickets()               │  │
        │ │ - showSupportTicket()            │  │
        │ │ - respondToTicket()              │  │
        │ │ - sendEmail() [private]          │  │
        │ └──────────────────────────────────┘  │
        └────────────────────────────────────────┘
                             │
                    ┌────────┴────────┐
                    ↓                 ↓
        ┌──────────────────┐  ┌──────────────────┐
        │     MODELS       │  │   VALIDATION     │
        │                  │  │                  │
        │ - Password       │  │ - Email format   │
        │   ResetRequest   │  │ - Min length     │
        │                  │  │ - Max length     │
        │ - SupportTicket  │  │ - Required fields│
        └──────────────────┘  └──────────────────┘
                    │
                    ↓
        ┌──────────────────────┐
        │   DATABASE (MySQL)   │
        │                      │
        │ - password_reset_    │
        │   requests           │
        │ - support_tickets    │
        └──────────────────────┘
                    │
                    ↓
        ┌──────────────────────┐
        │   EMAIL SERVICE      │
        │      (SMTP)          │
        │                      │
        │ Admin Email ────────→│
        │ User Email ─────────→│
        │ Gmail ──────────────→│
        └──────────────────────┘
```

---

## File Organization

```
app/
├── Http/
│   └── Controllers/
│       ├── SupportController.php
│       │   ├── showForgotPassword()
│       │   ├── submitForgotPassword()
│       │   ├── showSupportForm()
│       │   ├── submitSupportTicket()
│       │   └── sendAdminNotification() [private]
│       │
│       └── AdminSupportController.php
│           ├── passwordResets()
│           ├── showPasswordReset()
│           ├── resolvePasswordReset()
│           ├── rejectPasswordReset()
│           ├── supportTickets()
│           ├── showSupportTicket()
│           ├── respondToTicket()
│           └── sendEmail() [private]
│
├── Models/
│   ├── PasswordResetRequest.php
│   │   ├── user() - BelongsTo relationship
│   │   ├── pending() - Scope
│   │   └── recent() - Scope
│   │
│   └── SupportTicket.php
│       ├── user() - BelongsTo relationship
│       ├── open() - Scope
│       ├── recent() - Scope
│       ├── category() - Scope
│       └── priority() - Scope
│
└── Providers/
    └── AppServiceProvider.php

database/
├── migrations/
│   ├── 2025_12_02_000010_create_password_reset_requests_table.php
│   └── 2025_12_02_000011_create_support_tickets_table.php
│
└── seeders/

resources/
├── views/
│   ├── auth/
│   │   ├── login.blade.php [UPDATED]
│   │   ├── forgot-password.blade.php [NEW]
│   │   └── support-ticket.blade.php [NEW]
│   │
│   └── admin/
│       ├── password-resets.blade.php [NEW]
│       ├── password-reset-detail.blade.php [NEW]
│       ├── support-tickets.blade.php [NEW]
│       └── support-ticket-detail.blade.php [NEW]
│
└── css/
    └── (uses inline CSS)

routes/
└── web.php [UPDATED]
    ├── Public routes (forgot password, support)
    └── Admin routes (password reset management, ticket management)
```

---

## Request/Response Flow

### Forgot Password Request Flow

```
1. USER SUBMITS REQUEST
   ├─ POST /forgot-password
   │  └─ SupportController@submitForgotPassword()
   │
   ├─ VALIDATION
   │  ├─ Email required, valid format
   │  └─ Reason optional, max 500 chars
   │
   ├─ DATABASE OPERATION
   │  └─ CREATE PasswordResetRequest
   │     ├─ user_id
   │     ├─ email
   │     ├─ reason
   │     ├─ status = 'pending'
   │     └─ created_at
   │
   └─ EMAIL NOTIFICATION
      ├─ Send to: j.dutaro.545524@umindanao.edu.ph
      │  └─ Subject: "Password Reset Request"
      │  └─ Body: User info, reason, admin action link
      │
      └─ Response: Success message to user

2. ADMIN REVIEWS & RESOLVES
   ├─ GET /admin/support/password-resets/{id}
   │  └─ AdminSupportController@showPasswordReset()
   │
   ├─ POST /admin/support/password-resets/{id}/resolve
   │  └─ AdminSupportController@resolvePasswordReset()
   │
   ├─ DATABASE UPDATE
   │  └─ UPDATE PasswordResetRequest
   │     ├─ status = 'resolved'
   │     ├─ admin_notes
   │     └─ resolved_at
   │
   ├─ PASSWORD UPDATE
   │  └─ UPDATE User
   │     └─ password = bcrypt($newPassword)
   │
   └─ EMAIL NOTIFICATION
      ├─ Send to: user email
      │  └─ Subject: "Your Password Has Been Reset"
      │  └─ Body: New password, security warning
      │
      └─ Response: Success message to admin
```

### Support Ticket Request Flow

```
1. USER SUBMITS TICKET
   ├─ POST /support
   │  └─ SupportController@submitSupportTicket()
   │
   ├─ VALIDATION
   │  ├─ Name required, string
   │  ├─ Email required, valid format
   │  ├─ Gmail optional, valid email
   │  ├─ Subject required, max 255
   │  ├─ Concern required, max 2000
   │  ├─ Category required, in enum
   │  └─ Priority required, in enum
   │
   ├─ DATABASE OPERATION
   │  └─ CREATE SupportTicket
   │     ├─ name
   │     ├─ email
   │     ├─ gmail_account
   │     ├─ subject
   │     ├─ concern
   │     ├─ category
   │     ├─ priority
   │     ├─ status = 'open'
   │     └─ created_at
   │
   └─ EMAIL NOTIFICATIONS
      ├─ To User:
      │  ├─ Send to: user email
      │  │  └─ Subject: "Support Ticket Received #000001"
      │  │  └─ Body: Ticket details, confirmation
      │  │
      │  └─ (Also to Gmail if provided)
      │
      └─ To Admin:
         ├─ Send to: j.dutaro.545524@umindanao.edu.ph
         │  └─ Subject: "New Support Ticket #000001"
         │  └─ Body: Full ticket details, priority color

2. ADMIN REVIEWS & RESPONDS
   ├─ GET /admin/support/tickets/{id}
   │  └─ AdminSupportController@showSupportTicket()
   │
   ├─ POST /admin/support/tickets/{id}/respond
   │  └─ AdminSupportController@respondToTicket()
   │
   ├─ DATABASE UPDATE
   │  └─ UPDATE SupportTicket
   │     ├─ admin_response
   │     ├─ status (in_progress/resolved/closed)
   │     └─ responded_at
   │
   └─ EMAIL NOTIFICATION
      ├─ Send to: user email
      │  └─ Subject: "Support Response - Ticket #000001"
      │  └─ Body: Admin response, ticket status
      │
      └─ (Also to Gmail if provided)
```

---

## Database Schema

### password_reset_requests Table

```sql
CREATE TABLE password_reset_requests (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED (FK users.id),
    email VARCHAR(255) NOT NULL,
    reason TEXT,
    status ENUM('pending', 'resolved', 'rejected') DEFAULT 'pending',
    admin_notes VARCHAR(255),
    resolved_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
);
```

### support_tickets Table

```sql
CREATE TABLE support_tickets (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED (FK users.id, NULLABLE),
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    gmail_account VARCHAR(255),
    subject VARCHAR(255) NOT NULL,
    concern TEXT NOT NULL,
    category ENUM('password_reset', 'account_issue', 'technical_issue', 'feature_request', 'other') DEFAULT 'other',
    priority ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
    status ENUM('open', 'in_progress', 'resolved', 'closed') DEFAULT 'open',
    admin_response TEXT,
    responded_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_category (category),
    INDEX idx_created_at (created_at)
);
```

---

## Controller Method Signatures

### SupportController

```php
public function showForgotPassword()
// Returns: forgot-password view

public function submitForgotPassword(Request $request)
// Input: email, reason
// Returns: back() with success/error message
// Creates: PasswordResetRequest record
// Sends: Email to admin

public function showSupportForm()
// Returns: support-ticket view

public function submitSupportTicket(Request $request)
// Input: name, email, gmail_account, subject, concern, category, priority
// Returns: back() with success/error message
// Creates: SupportTicket record
// Sends: Emails to user and admin
```

### AdminSupportController

```php
public function passwordResets(Request $request)
// Returns: password-resets view with paginated requests
// Filters: by status (pending, resolved, rejected, all)

public function showPasswordReset(PasswordResetRequest $request)
// Returns: password-reset-detail view

public function resolvePasswordReset(Request $request, PasswordResetRequest $passwordResetRequest)
// Input: new_password, admin_notes
// Updates: User password, PasswordResetRequest status
// Sends: Password email to user
// Returns: back() with success message

public function rejectPasswordReset(Request $request, PasswordResetRequest $passwordResetRequest)
// Input: rejection_reason
// Updates: PasswordResetRequest status to 'rejected'
// Sends: Rejection email to user
// Returns: back() with success message

public function supportTickets(Request $request)
// Returns: support-tickets view with paginated tickets
// Filters: by status, category

public function showSupportTicket(SupportTicket $ticket)
// Returns: support-ticket-detail view

public function respondToTicket(Request $request, SupportTicket $ticket)
// Input: response, status
// Updates: SupportTicket admin_response, status, responded_at
// Sends: Response email to user and gmail (if provided)
// Returns: back() with success message
```

---

## Validation Rules

### Forgot Password
```php
[
    'email' => ['required', 'email'],
    'reason' => ['nullable', 'string', 'max:500'],
]
```

### Support Ticket
```php
[
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'email'],
    'gmail_account' => ['nullable', 'email'],
    'subject' => ['required', 'string', 'max:255'],
    'concern' => ['required', 'string', 'max:2000'],
    'category' => ['required', 'in:password_reset,account_issue,technical_issue,feature_request,other'],
    'priority' => ['required', 'in:low,medium,high,urgent'],
]
```

### Password Reset (Admin)
```php
[
    'new_password' => ['required', 'string', 'min:8'],
    'admin_notes' => ['nullable', 'string', 'max:500'],
]
```

### Ticket Response (Admin)
```php
[
    'response' => ['required', 'string', 'max:2000'],
    'status' => ['required', 'in:in_progress,resolved,closed'],
]
```

---

## Route Definitions

```php
// Public Routes
Route::get('/forgot-password', [SupportController::class, 'showForgotPassword'])
    ->name('support.forgot-password');
Route::post('/forgot-password', [SupportController::class, 'submitForgotPassword'])
    ->name('support.forgot-password');
    
Route::get('/support', [SupportController::class, 'showSupportForm'])
    ->name('support.form');
Route::post('/support', [SupportController::class, 'submitSupportTicket'])
    ->name('support.submit-ticket');

// Protected Routes (OWNER only)
Route::middleware(['auth', 'role:OWNER'])->prefix('admin/support')->name('admin.support.')->group(function () {
    // Password Reset Routes
    Route::get('/password-resets', [AdminSupportController::class, 'passwordResets'])
        ->name('password-resets');
    Route::get('/password-resets/{passwordResetRequest}', [AdminSupportController::class, 'showPasswordReset'])
        ->name('password-reset.show');
    Route::post('/password-resets/{passwordResetRequest}/resolve', [AdminSupportController::class, 'resolvePasswordReset'])
        ->name('password-reset.resolve');
    Route::post('/password-resets/{passwordResetRequest}/reject', [AdminSupportController::class, 'rejectPasswordReset'])
        ->name('password-reset.reject');
    
    // Support Ticket Routes
    Route::get('/tickets', [AdminSupportController::class, 'supportTickets'])
        ->name('tickets');
    Route::get('/tickets/{ticket}', [AdminSupportController::class, 'showSupportTicket'])
        ->name('ticket.show');
    Route::post('/tickets/{ticket}/respond', [AdminSupportController::class, 'respondToTicket'])
        ->name('ticket.respond');
});
```

---

## Model Relationships

### PasswordResetRequest Model

```php
class PasswordResetRequest extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
```

### SupportTicket Model

```php
class SupportTicket extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }
    
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
    
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }
    
    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }
}
```

---

## View Template Structure

### User-Facing Views
- `forgot-password.blade.php` - Forgot password form
- `support-ticket.blade.php` - Support ticket form
- Both include validation error displays and success messages

### Admin Views
- `password-resets.blade.php` - List of password reset requests with filtering
- `password-reset-detail.blade.php` - Detail view with resolve/reject forms
- `support-tickets.blade.php` - List of support tickets with filtering
- `support-ticket-detail.blade.php` - Detail view with response form

---

**Architecture Version:** 1.0
**Last Updated:** December 2, 2025
