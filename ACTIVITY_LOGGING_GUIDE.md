## Comprehensive Activity Logging System - Implementation Guide

### Overview
A complete activity logging system has been implemented to track all CRUD operations (Create, Update, Delete, Archive) across all major modules of the application.

### Modules Covered
1. **Projects** - CREATE, UPDATE, DELETE, ARCHIVE, UNARCHIVE
2. **Materials** - CREATE, UPDATE, DELETE, ARCHIVE (cascading)
3. **Invoices** - CREATE, UPDATE, DELETE
4. **Purchase Orders** - CREATE, UPDATE, DELETE
5. **Project Records** - CREATE, UPDATE, DELETE
6. **Clients** - CREATE, UPDATE, DELETE
7. **Users** - CREATE, UPDATE, DELETE
8. **Authentication** - LOGIN, LOGOUT (existing)

### Implementation Details

#### 1. Observers Created
Located in `app/Observers/`:

- **ProjectObserver.php** - Tracks project lifecycle, archival, and material cascading
- **MaterialObserver.php** - Logs material changes
- **InvoiceObserver.php** - Logs invoice changes
- **PurchaseOrderObserver.php** - Logs PO changes
- **ProjectRecordObserver.php** - Logs project record changes
- **ClientObserver.php** - Logs client changes
- **UserObserver.php** - Logs user changes

#### 2. Database Storage
All activity is stored in the `logs` table with fields:
- `user_id` - ID of the user performing the action
- `action` - Action type (CREATE_PROJECT, UPDATE_MATERIAL, etc.)
- `log_date` - Timestamp of the activity
- `details` - JSON-encoded details specific to the action

#### 3. Activity Log Controller
File: `app/Http/Controllers/ActivityLogController.php`

Features:
- View all activities with pagination (50 per page)
- Filter by action type
- Filter by user
- Filter by date range
- Search and view detailed information

#### 4. Activity Log View
File: `resources/views/activity-log.blade.php`

Features:
- Professional dashboard interface
- Real-time filtering
- Color-coded action badges:
  - Green: CREATE actions
  - Blue: UPDATE actions
  - Red: DELETE actions
  - Yellow: ARCHIVE actions
  - Purple: LOGIN/LOGOUT actions
- Pagination support
- Responsive design

#### 5. Routes
Added to `routes/web.php`:
```php
Route::middleware('role:OWNER')->group(function () {
    Route::get('/activity-log', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity-log.index');
    Route::get('/activity-log/{log}', [App\Http\Controllers\ActivityLogController::class, 'show'])->name('activity-log.show');
});
```

#### 6. Service Provider Registration
File: `app/Providers/AppServiceProvider.php`

All observers are registered in the `boot()` method:
```php
Project::observe(ProjectObserver::class);
Material::observe(MaterialObserver::class);
Invoice::observe(InvoiceObserver::class);
PurchaseOrder::observe(PurchaseOrderObserver::class);
ProjectRecord::observe(ProjectRecordObserver::class);
Client::observe(ClientObserver::class);
User::observe(UserObserver::class);
```

### Action Types Logged

#### Project Actions
- `CREATE_PROJECT` - New project created
- `UPDATE_PROJECT` - Project details updated
- `DELETE_PROJECT` - Project deleted
- `ARCHIVE_PROJECT` - Project archived with reason
- `UNARCHIVE_PROJECT` - Project restored from archive

#### Material Actions
- `CREATE_MATERIAL` - New material added
- `UPDATE_MATERIAL` - Material details updated (including status changes)
- `DELETE_MATERIAL` - Material deleted

#### Invoice Actions
- `CREATE_INVOICE` - New invoice created
- `UPDATE_INVOICE` - Invoice updated
- `DELETE_INVOICE` - Invoice deleted

#### Purchase Order Actions
- `CREATE_PURCHASE_ORDER` - New PO created
- `UPDATE_PURCHASE_ORDER` - PO updated
- `DELETE_PURCHASE_ORDER` - PO deleted

#### Project Record Actions
- `CREATE_PROJECT_RECORD` - New project record created
- `UPDATE_PROJECT_RECORD` - Project record updated
- `DELETE_PROJECT_RECORD` - Project record deleted

#### Client Actions
- `CREATE_CLIENT` - New client created
- `UPDATE_CLIENT` - Client information updated
- `DELETE_CLIENT` - Client deleted

#### User Actions
- `CREATE_USER` - New user account created
- `UPDATE_USER` - User profile updated
- `DELETE_USER` - User account deleted

#### Authentication Actions
- `LOGIN` - User logged in
- `LOGOUT` - User logged out

### Data Captured in Details

Each action logs relevant details including:
- Resource IDs and names
- Changed fields (for updates)
- User who performed the action
- Timestamp of the action
- Additional context (e.g., archive reason, status changes)

### Access Control
The activity log is accessible only to users with the **OWNER** role, ensuring sensitive audit information remains secure.

### Example Usage

#### Accessing Activity Log
Navigate to `/activity-log` to view all activities.

#### Filtering Activities
- Select an action type from the dropdown
- Choose a date range
- Click "Apply Filters" to see results

#### Viewing Details
Click "View Details" on any log entry to see the full JSON details of that activity.

### Benefits
1. **Audit Trail** - Complete history of all changes to critical data
2. **Accountability** - Track which user made which changes
3. **Compliance** - Meet regulatory requirements for activity logging
4. **Troubleshooting** - Easily trace the cause of issues
5. **Security** - Detect unauthorized changes or suspicious activity
6. **User Feedback** - Understand how users interact with the system

### Future Enhancements
- Export activity logs to CSV/PDF
- Real-time activity notifications
- Activity rollback functionality
- Advanced analytics and reporting
- IP address and user agent tracking
- Detailed change diff visualization
