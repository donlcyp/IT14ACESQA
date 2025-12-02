# Forgot Password & Support System Documentation

## Overview

A comprehensive forgot password and support ticketing system has been implemented for AJJ CRISBER Engineering Services. This system allows users to:

1. **Reset their password** if they forget it by submitting a password reset request
2. **Submit support tickets** for any concerns, account issues, technical problems, or feature requests
3. **Add their Gmail account** for alternative contact methods

The system includes admin features to manage password reset requests and support tickets with email notifications.

---

## Features

### User-Side Features

#### 1. **Forgot Password**
- Users can access the forgot password page from the login screen
- Link: `/forgot-password`
- Route name: `support.forgot-password`
- **Form Fields:**
  - Email address (required)
  - Reason for password reset (optional)

**Workflow:**
1. User enters their email and submits the form
2. System creates a password reset request and stores it in the database
3. Admin receives an email notification about the request
4. User receives a confirmation message
5. Admin reviews the request and resets the password via admin dashboard
6. User receives their new password via email

#### 2. **Support Ticket System**
- Users can submit support tickets for various concerns
- Link: `/support`
- Route name: `support.form`
- **Form Fields:**
  - Full Name (required)
  - Email Address (required)
  - Gmail Account (optional - for alternative contact)
  - Subject (required)
  - Category (required): 
    - Password Reset
    - Account Issue
    - Technical Issue
    - Feature Request
    - Other
  - Priority (required):
    - Low
    - Medium
    - High
    - Urgent
  - Concern/Description (required, max 2000 characters)

**Workflow:**
1. User fills out the support form with their concern
2. System creates a support ticket with a unique ticket ID (#000001 format)
3. User receives a confirmation email with their ticket details
4. Admin receives a notification email about the new ticket
5. Admin reviews and responds to the ticket via admin dashboard
6. User receives the admin's response via email (sent to both primary email and Gmail if provided)

---

### Admin-Side Features

#### 1. **Password Reset Requests Dashboard**
- **Route:** `/admin/support/password-resets`
- **Route Name:** `admin.support.password-resets`
- **Access:** OWNER role only

**Features:**
- View all password reset requests with status filtering:
  - Pending (awaiting action)
  - Resolved (password reset sent)
  - Rejected (request denied)
- Filter by status
- View detailed request information

#### 2. **Password Reset Detail Page**
- **Route:** `/admin/support/password-resets/{id}`
- **Route Name:** `admin.support.password-reset.show`
- **Access:** OWNER role only

**Actions:**
- **Resolve Request:** 
  - Generate or enter a new password
  - Add optional admin notes
  - System automatically emails the new password to the user
  - Request status changes to "Resolved"

- **Reject Request:**
  - Provide rejection reason
  - System sends rejection email to user
  - Request status changes to "Rejected"

#### 3. **Support Tickets Dashboard**
- **Route:** `/admin/support/tickets`
- **Route Name:** `admin.support.tickets`
- **Access:** OWNER role only

**Features:**
- View all support tickets with status filtering:
  - Open (new/unaddressed)
  - In Progress (being worked on)
  - Resolved (issue resolved)
  - Closed (ticket closed)
- Filter by status and category
- View ticket metrics and statistics

#### 4. **Support Ticket Detail Page**
- **Route:** `/admin/support/tickets/{id}`
- **Route Name:** `admin.support.ticket.show`
- **Access:** OWNER role only

**Information Displayed:**
- Ticket ID and subject
- Customer name, email, and Gmail account (if provided)
- Complete concern description
- Category and priority level
- Current status
- Any previous admin response
- Submission date and time

**Admin Actions:**
- Send response to customer
- Update ticket status:
  - In Progress
  - Resolved
  - Closed
- Response automatically emails customer (including Gmail if provided)

---

## Database Tables

### password_reset_requests

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key to users table |
| email | string | User's email address |
| reason | text | User's reason for password reset |
| status | enum | 'pending', 'resolved', 'rejected' |
| admin_notes | string | Admin's notes about the request |
| resolved_at | timestamp | When the request was resolved/rejected |
| created_at | timestamp | When the request was submitted |
| updated_at | timestamp | Last update timestamp |

### support_tickets

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key to users table (nullable) |
| name | string | Customer's full name |
| email | string | Customer's primary email |
| gmail_account | string | Customer's Gmail account (nullable) |
| subject | string | Ticket subject |
| concern | text | Detailed concern description |
| category | enum | Category of the ticket |
| priority | enum | Ticket priority level |
| status | enum | 'open', 'in_progress', 'resolved', 'closed' |
| admin_response | text | Admin's response to the ticket |
| responded_at | timestamp | When admin responded |
| created_at | timestamp | When ticket was submitted |
| updated_at | timestamp | Last update timestamp |

---

## Email Configuration

The system sends emails to:
- **Admin Email:** `j.dutaro.545524@umindanao.edu.ph`
- **User Emails:** From the form submission

**Make sure your `.env` file is configured correctly:**

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@ajjcrisber.com
MAIL_FROM_NAME="AJJ CRISBER Engineering Services"
```

---

## Routes Summary

### Public Routes (No Authentication Required)
| Route | Method | Name | Controller@Method |
|-------|--------|------|------------------|
| `/forgot-password` | GET | `support.forgot-password` | SupportController@showForgotPassword |
| `/forgot-password` | POST | `support.forgot-password` | SupportController@submitForgotPassword |
| `/support` | GET | `support.form` | SupportController@showSupportForm |
| `/support` | POST | `support.submit-ticket` | SupportController@submitSupportTicket |

### Protected Routes (OWNER Only)
| Route | Method | Name | Controller@Method |
|-------|--------|------|------------------|
| `/admin/support/password-resets` | GET | `admin.support.password-resets` | AdminSupportController@passwordResets |
| `/admin/support/password-resets/{id}` | GET | `admin.support.password-reset.show` | AdminSupportController@showPasswordReset |
| `/admin/support/password-resets/{id}/resolve` | POST | `admin.support.password-reset.resolve` | AdminSupportController@resolvePasswordReset |
| `/admin/support/password-resets/{id}/reject` | POST | `admin.support.password-reset.reject` | AdminSupportController@rejectPasswordReset |
| `/admin/support/tickets` | GET | `admin.support.tickets` | AdminSupportController@supportTickets |
| `/admin/support/tickets/{id}` | GET | `admin.support.ticket.show` | AdminSupportController@showSupportTicket |
| `/admin/support/tickets/{id}/respond` | POST | `admin.support.ticket.respond` | AdminSupportController@respondToTicket |

---

## Models

### PasswordResetRequest
- **Location:** `app/Models/PasswordResetRequest.php`
- **Relationship:** belongsTo User
- **Scopes:**
  - `pending()` - Get pending requests
  - `recent()` - Order by most recent

### SupportTicket
- **Location:** `app/Models/SupportTicket.php`
- **Relationship:** belongsTo User (nullable)
- **Scopes:**
  - `open()` - Get open tickets
  - `recent()` - Order by most recent
  - `category($category)` - Filter by category
  - `priority($priority)` - Filter by priority

---

## Usage Examples

### Submitting a Password Reset Request

**User Steps:**
1. Click "Forgot Password?" on login page
2. Enter email address
3. Optionally add reason
4. Submit form
5. View confirmation message
6. Wait for admin email with password

**Admin Steps:**
1. Navigate to `/admin/support/password-resets`
2. View pending requests
3. Click "View" on the request
4. Enter new password
5. Optionally add notes
6. Click "Resolve & Send Password"
7. System sends password email to user

### Submitting a Support Ticket

**User Steps:**
1. Click "Contact Support" on login page
2. Fill in form:
   - Name and email
   - Add Gmail account (optional)
   - Select category and priority
   - Describe concern
3. Submit form
4. View confirmation with ticket ID
5. Receive confirmation email

**Admin Steps:**
1. Navigate to `/admin/support/tickets`
2. View tickets by status or category
3. Click "View" on ticket
4. Read customer's concern
5. Click response form
6. Type response message
7. Select new status (in progress/resolved/closed)
8. Click "Send Response"
9. Customer receives response email

---

## Security Notes

- Password reset requests are tied to user accounts
- Support tickets can be submitted by both authenticated and unauthenticated users
- Admin access is restricted to OWNER role only
- All user data is stored securely in the database
- Emails are sent through configured mail service

---

## Customization

### Email Templates
To customize email messages, edit the `sendEmail()` and related methods in `AdminSupportController.php` and `SupportController.php`.

### Admin Email Address
Change the admin email from `j.dutaro.545524@umindanao.edu.ph` to your preferred email in:
- `SupportController.php`
- `AdminSupportController.php`

### Priority Colors
Priority colors are defined in `AdminSupportController.php` in the `getPriorityColor()` method.

---

## Troubleshooting

### Emails Not Sending
1. Check mail configuration in `.env`
2. Verify SMTP credentials
3. Check Laravel logs: `storage/logs/laravel.log`
4. Test with `php artisan tinker` and Mail::test()

### Cannot Access Admin Pages
1. Ensure user has OWNER role
2. Check `app/Providers/AuthServiceProvider.php` or middleware

### Database Table Not Exists
Run migrations: `php artisan migrate`

---

## File Structure

```
app/
├── Http/Controllers/
│   ├── SupportController.php (handles user requests)
│   └── AdminSupportController.php (handles admin actions)
├── Models/
│   ├── PasswordResetRequest.php
│   └── SupportTicket.php

database/
└── migrations/
    ├── 2025_12_02_000010_create_password_reset_requests_table.php
    └── 2025_12_02_000011_create_support_tickets_table.php

resources/views/
├── auth/
│   ├── login.blade.php (updated with forgot password link)
│   ├── forgot-password.blade.php (new)
│   └── support-ticket.blade.php (new)
└── admin/
    ├── password-resets.blade.php (new)
    ├── password-reset-detail.blade.php (new)
    ├── support-tickets.blade.php (new)
    └── support-ticket-detail.blade.php (new)

routes/
└── web.php (updated with new routes)
```

---

## Testing

To test the system:

1. **Test Forgot Password:**
   - Go to `/forgot-password`
   - Enter your email
   - Check admin email for notification
   - Admin logs in and resolves request
   - Check user email for new password

2. **Test Support Ticket:**
   - Go to `/support`
   - Fill out form with various categories/priorities
   - Check user email for confirmation
   - Check admin email for notification
   - Admin logs in, views ticket, and responds
   - Check user email for response

---

## Support

For questions or issues with this system, contact the development team.
