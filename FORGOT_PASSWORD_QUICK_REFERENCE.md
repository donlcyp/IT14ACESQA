# Forgot Password & Support System - Quick Reference Guide

## System Overview

```
LOGIN PAGE
    ↓
┌─────────────────────────────────────┐
│  Forgot Password? | Contact Support │
└────────┬──────────────────────┬─────┘
         ↓                      ↓
   [FORGOT PASSWORD]      [SUPPORT TICKET]
   /forgot-password        /support
    ↓                      ↓
User submits email     User submits form
   ↓                      ↓
EMAIL to ADMIN ────→ j.dutaro.545524@umindanao.edu.ph ←──── EMAIL to ADMIN
   ↓                      ↓
ADMIN PORTAL          ADMIN PORTAL
/admin/support/      /admin/support/
password-resets      tickets
   ↓                      ↓
Reset Password       Respond to Ticket
   ↓                      ↓
EMAIL USER ──────→ new password      EMAIL USER ──────→ response + gmail
```

---

## Quick Links

### For Users
| Purpose | URL | Link Name |
|---------|-----|-----------|
| Reset Password | `/forgot-password` | `support.forgot-password` |
| Contact Support | `/support` | `support.form` |
| Login | `/login` | `login` |

### For Admin (OWNER only)
| Purpose | URL | Link Name |
|---------|-----|-----------|
| Password Reset Requests | `/admin/support/password-resets` | `admin.support.password-resets` |
| Support Tickets | `/admin/support/tickets` | `admin.support.tickets` |

---

## Form Fields Reference

### Forgot Password Form
```
✓ Email Address (required)
✓ Reason (optional)
```

### Support Ticket Form
```
✓ Full Name (required)
✓ Email Address (required)
✓ Gmail Account (optional)
✓ Subject (required)
✓ Category (required)
  - Password Reset
  - Account Issue
  - Technical Issue
  - Feature Request
  - Other
✓ Priority (required)
  - Low
  - Medium
  - High
  - Urgent
✓ Concern/Description (required, max 2000 chars)
```

---

## Email Flow

### Password Reset
```
1. User submits forgot password form
   ↓
2. System stores request in password_reset_requests table
   ↓
3. EMAIL → Admin: "Password Reset Request from [User]"
   ↓
4. Admin goes to /admin/support/password-resets/[id]
   ↓
5. Admin enters new password & clicks "Resolve"
   ↓
6. EMAIL → User: "Your Password Has Been Reset"
   Body includes:
   - New password
   - Warning to change after login
   - Link to login
```

### Support Ticket
```
1. User submits support form
   ↓
2. System stores ticket in support_tickets table
   ↓
3. EMAIL → User: "Support Ticket Received #000001"
   ↓
4. EMAIL → Admin: "New Support Ticket #000001"
   ↓
5. Admin goes to /admin/support/tickets/[id]
   ↓
6. Admin types response & clicks "Send Response"
   ↓
7. EMAIL → User: "We've Responded to Your Ticket"
   Body includes:
   - Ticket ID
   - Admin's response
   - Status update
   ↓
8. EMAIL → Gmail: (if provided) Same as above
```

---

## Database Quick View

### password_reset_requests Table
- `id` - Request ID
- `user_id` - Which user
- `email` - Their email
- `reason` - Why they forgot
- `status` - pending/resolved/rejected
- `admin_notes` - Admin's notes
- `resolved_at` - When admin handled it
- `created_at` - When submitted

### support_tickets Table
- `id` - Ticket ID (shown as #000001)
- `user_id` - Which user (if logged in)
- `name` - Customer name
- `email` - Primary email
- `gmail_account` - Gmail (optional)
- `subject` - Issue title
- `concern` - Full description
- `category` - Type of issue
- `priority` - Low/Medium/High/Urgent
- `status` - open/in_progress/resolved/closed
- `admin_response` - Admin's reply
- `responded_at` - When admin replied
- `created_at` - When submitted

---

## Status Indicators

### Password Reset Request Status
- 🟨 **Pending** - Waiting for admin action
- 🟢 **Resolved** - Password reset sent
- 🔴 **Rejected** - Request denied

### Support Ticket Status
- 🟨 **Open** - New ticket, needs attention
- 🔵 **In Progress** - Admin is working on it
- 🟢 **Resolved** - Issue resolved, awaiting closure
- ⚫ **Closed** - Ticket closed

---

## Priority Color Codes

| Priority | Color | Meaning |
|----------|-------|---------|
| Low | 🔵 Blue | Can be handled anytime |
| Medium | 🟨 Yellow | Standard priority |
| High | 🔴 Light Red | Needs quick attention |
| Urgent | 🔴 Dark Red | Critical, immediate action |

---

## Admin Workflow - Password Reset

```
STEP 1: View Requests
└─ Go to /admin/support/password-resets
└─ Filter by "Pending"
└─ Click "View" on a request

STEP 2: Review Request
└─ Read user's name, email, reason
└─ Verify it's a legitimate request

STEP 3: Resolve Request
└─ Enter new password (min 8 chars)
└─ Add optional notes
└─ Click "Resolve & Send Password"
└─ ✓ Password sent to user email
└─ ✓ Request marked as "Resolved"

STEP 4: (Optional) Reject Request
└─ If request is suspicious, click "Reject Request"
└─ Enter rejection reason
└─ Click "Reject Request"
└─ ✓ Rejection email sent to user
└─ ✓ Request marked as "Rejected"
```

---

## Admin Workflow - Support Ticket

```
STEP 1: View Tickets
└─ Go to /admin/support/tickets
└─ Filter by status/category
└─ Click "View" on a ticket

STEP 2: Review Ticket
└─ Read customer info (name, email, gmail)
└─ Read their concern
└─ Check category and priority

STEP 3: Respond to Ticket
└─ Type your response in the text area
└─ Select new status:
   └─ "In Progress" = still working on it
   └─ "Resolved" = issue is fixed
   └─ "Closed" = ticket can be closed
└─ Click "Send Response"
└─ ✓ Response sent to email + gmail (if provided)
└─ ✓ Ticket status updated
└─ ✓ responded_at timestamp set

STEP 4: Track Ticket
└─ View ticket list to see response date
└─ Can respond multiple times to same ticket
└─ Each response updates the ticket
```

---

## Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| Email not sending | Check MAIL_* settings in .env |
| Can't access admin pages | Ensure user has OWNER role |
| Table doesn't exist | Run `php artisan migrate` |
| Forgot password link not visible | Check that login.blade.php is updated |
| Password reset response not in view | Ensure AdminSupportController is properly defined |

---

## Configuration File Locations

- **Routes:** `routes/web.php`
- **Controllers:** `app/Http/Controllers/SupportController.php` and `AdminSupportController.php`
- **Models:** `app/Models/PasswordResetRequest.php` and `SupportTicket.php`
- **Views:** `resources/views/auth/` and `resources/views/admin/`
- **Migrations:** `database/migrations/`
- **Mail Config:** `.env` file (MAIL_* variables)

---

## Key Features Summary

✅ Forgot Password System
✅ Support Ticket System  
✅ Gmail Account Support
✅ Admin Dashboard
✅ Email Notifications
✅ Status Tracking
✅ Response Management
✅ Priority Levels
✅ Category Organization
✅ Character Counter on Forms
✅ Responsive Design
✅ Secure Password Reset
✅ Multiple Email Contacts

---

## Email Templates

### Password Reset Email (To User)
- Subject: "Your Password Has Been Reset"
- Contains: New password, security warning, login link

### Password Reset Notification (To Admin)
- Subject: "Password Reset Request - [User Name]"
- Contains: User info, reason, request details, link to admin panel

### Support Ticket Confirmation (To User)
- Subject: "Support Ticket Received - #000001"
- Contains: Ticket ID, submitted details, confirmation

### Support Ticket Notification (To Admin)
- Subject: "New Support Ticket - #000001 [Category]"
- Contains: Full ticket details, priority, customer info, link to respond

### Support Ticket Response (To User + Gmail)
- Subject: "Support Response - Ticket #000001"
- Contains: Ticket ID, admin response, status update

---

## Version Information

- **Created:** December 2, 2025
- **Framework:** Laravel 10+
- **PHP Version:** 7.4+
- **Database:** MySQL 5.7+

---

## Support Contact

For issues or questions, contact:
- **Admin Email:** j.dutaro.545524@umindanao.edu.ph
- **System:** AJJ CRISBER Engineering Services
