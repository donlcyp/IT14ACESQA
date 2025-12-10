# 🕐 Bundy Clock Integration Guide

## Overview

This guide explains how to integrate physical bundy clock (time clock) devices with the AJJ CRISBER Engineering Services attendance system. The integration allows employees to punch in/out using hardware devices, with data automatically flowing into your database.

---

## 🔌 Integration Methods

### Method 1: API-Based Integration (Recommended)

Most modern bundy clocks have network connectivity (WiFi/Ethernet) and can send data via HTTP/REST API.

#### Setup Steps:

1. **Configure Bundy Clock Device**
   - Access your bundy clock's admin panel
   - Set API endpoint: `https://your-domain.com/api/bundy-clock/punch`
   - Set authentication token (see Security section)
   - Configure to send data in JSON format

2. **API Endpoints Available**

   | Endpoint | Method | Description |
   |----------|--------|-------------|
   | `/api/bundy-clock/punch` | POST | Single punch record |
   | `/api/bundy-clock/batch` | POST | Multiple punch records |
   | `/api/bundy-clock/health` | GET | Health check |
   | `/api/bundy-clock/test` | POST | Test connection |

3. **Data Format**

   **Single Punch:**
   ```json
   {
       "employee_id": "123",
       "timestamp": "2025-12-09 08:30:15",
       "action": "in",
       "device_id": "BUNDY001"
   }
   ```

   **Batch Punch:**
   ```json
   {
       "device_id": "BUNDY001",
       "records": [
           {
               "employee_id": "123",
               "timestamp": "2025-12-09 08:30:15",
               "action": "in"
           },
           {
               "employee_id": "124",
               "timestamp": "2025-12-09 08:35:20",
               "action": "in"
           }
       ]
   }
   ```

---

### Method 2: Database Direct Connection

Some bundy clocks store data locally and can sync to external databases.

#### Setup Steps:

1. **Allow bundy clock database connection**
   - Add bundy clock IP to MySQL allowed hosts
   - Create dedicated database user with INSERT permissions only

2. **Configure Bundy Clock**
   - Database host: your server IP
   - Database: `it14acesqa` (your database name)
   - Table: `employee_attendance`
   - Mapping:
     - Badge Number → `employee_id`
     - Timestamp → `punch_in_time` or `punch_out_time`
     - Action → determines which field to update

3. **Security Considerations**
   - Use read-only user for employee data
   - Use insert-only user for attendance
   - Restrict by IP address
   - Enable SSL for database connections

---

### Method 3: CSV/File Import

For bundy clocks that generate CSV files periodically.

#### Setup Steps:

1. **Configure bundy clock to export CSV**
   - Format: `employee_id,timestamp,action`
   - Schedule: Every 30 minutes or hourly

2. **Set up file monitoring**
   - Use Laravel scheduled task to check for new files
   - Parse CSV and import to database
   - Archive processed files

**Example CSV:**
```csv
employee_id,timestamp,action
123,2025-12-09 08:30:15,in
124,2025-12-09 08:35:20,in
123,2025-12-09 17:00:00,out
```

---

## 🔐 Security Implementation

### API Authentication

Add authentication middleware to protect bundy clock endpoints:

**Option A: API Token Authentication**
```php
// In bundy clock device settings
Headers:
Authorization: Bearer YOUR_SECRET_TOKEN_HERE
```

**Option B: IP Whitelist**
```php
// In BundyClockController or middleware
$allowedIPs = ['192.168.1.100', '10.0.0.50'];
if (!in_array($request->ip(), $allowedIPs)) {
    return response()->json(['error' => 'Unauthorized'], 403);
}
```

---

## 📋 Employee Badge/ID Setup

### Synchronizing Employee IDs with Bundy Clock

1. **Using Employee ID**
   - Assign each employee a unique badge number in bundy clock
   - Match this with `employee_id` in your database

2. **Using Employee Code**
   - If your bundy clock uses custom codes
   - Add `employee_code` field to `employee_list` table
   - Controller will match by either ID or code

3. **Badge Assignment Checklist**
   ```
   □ Register employee in database
   □ Note their employee_id (e.g., 123)
   □ Register badge in bundy clock with same ID
   □ Test punch in/out
   □ Verify data appears in attendance table
   ```

---

## 🎯 Testing the Integration

### 1. Test Endpoint
```bash
curl -X POST http://your-domain.com/api/bundy-clock/test \
  -H "Content-Type: application/json" \
  -d '{"test": "data"}'
```

### 2. Test Single Punch
```bash
curl -X POST http://your-domain.com/api/bundy-clock/punch \
  -H "Content-Type: application/json" \
  -d '{
    "employee_id": "1",
    "timestamp": "2025-12-09 08:30:15",
    "action": "in",
    "device_id": "BUNDY001"
  }'
```

### 3. Test Batch Punch
```bash
curl -X POST http://your-domain.com/api/bundy-clock/batch \
  -H "Content-Type: application/json" \
  -d '{
    "device_id": "BUNDY001",
    "records": [
      {"employee_id": "1", "timestamp": "2025-12-09 08:30:15", "action": "in"},
      {"employee_id": "2", "timestamp": "2025-12-09 08:35:20", "action": "in"}
    ]
  }'
```

### 4. Health Check
```bash
curl http://your-domain.com/api/bundy-clock/health
```

---

## 📊 Attendance Workflow

### Complete Flow:

1. **Employee arrives at work**
   - Taps badge on bundy clock
   - Bundy clock reads badge number (employee_id)
   - Device sends punch data to your server

2. **Server receives data**
   - `BundyClockController` validates data
   - Checks if employee exists
   - Creates/updates attendance record

3. **Attendance record created**
   ```php
   EmployeeAttendance {
       employee_id: 123,
       date: "2025-12-09",
       punch_in_time: "08:30:15",
       attendance_status: "On Site",
       is_late: false,
       validation_status: "pending"
   }
   ```

4. **HR validates attendance**
   - HR/Timekeeper reviews punch records
   - Approves or rejects attendance
   - System marks as "Present" if approved

5. **Employee leaves work**
   - Taps badge on bundy clock again
   - System records punch_out_time
   - Calculates hours worked
   - Updates status to "Present"

---

## 🛠️ Troubleshooting

### Common Issues:

#### 1. Employee Not Found
**Problem:** Bundy clock sends ID that doesn't exist in database
**Solution:** 
- Check employee_id matches between systems
- Verify employee hasn't been deleted
- Check logs: `storage/logs/laravel.log`

#### 2. Already Punched In/Out
**Problem:** Employee tries to punch in twice
**Solution:**
- Check if previous record exists for today
- Manual override by admin if needed
- Configure bundy clock to prevent duplicate punches

#### 3. Connection Failed
**Problem:** Bundy clock can't reach server
**Solution:**
- Verify network connectivity
- Check firewall rules
- Ensure endpoint URL is correct
- Test with curl from bundy clock network

#### 4. Invalid Timestamp
**Problem:** Date format doesn't match
**Solution:**
- Configure bundy clock to send: `Y-m-d H:i:s` format
- Example: `2025-12-09 08:30:15`

---

## 📱 Supported Bundy Clock Brands

### Tested Compatible:

1. **ZKTeco**
   - Models: K40, K50, MB360
   - Connection: WiFi/Ethernet + API
   - Setup: Configure Web Server settings

2. **Suprema BioStation**
   - Models: BioStation 2, BioStation 3
   - Connection: REST API
   - Setup: Enable API in admin panel

3. **Anviz**
   - Models: T5S, W2
   - Connection: WiFi + HTTP Push
   - Setup: Configure server address

4. **eSSL**
   - Models: X990, K90
   - Connection: TCP/IP + SDK
   - Setup: May require custom middleware

### Generic IP-Based Bundy Clocks:
- Any device supporting HTTP POST
- Must allow custom endpoint configuration
- JSON or CSV data format

---

## 🔧 Configuration

### Laravel Configuration

**1. Add routes** (Already included in `routes/web.php`):
```php
Route::prefix('api/bundy-clock')->group(function () {
    Route::post('/punch', [BundyClockController::class, 'receivePunch']);
    Route::post('/batch', [BundyClockController::class, 'receiveBatchPunch']);
    Route::get('/health', [BundyClockController::class, 'healthCheck']);
    Route::post('/test', [BundyClockController::class, 'test']);
});
```

**2. Configure CORS** (if needed):
```php
// config/cors.php
'paths' => ['api/*', 'api/bundy-clock/*'],
'allowed_origins' => ['*'], // Or specific bundy clock IP
```

**3. Grace Period Settings**
```php
// In BundyClockController line ~130
$scheduledStart = Carbon::parse($attendance->date)->setHour(8)->setMinute(0);
$gracePeriodEnd = $scheduledStart->copy()->addMinutes(15); // 15 minutes grace
```

---

## 📈 Monitoring & Logs

### View Bundy Clock Activity:
```bash
# Real-time logs
tail -f storage/logs/laravel.log | grep "Bundy Clock"

# Search for specific employee
grep "employee_id.*123" storage/logs/laravel.log

# Count successful punches today
grep "Bundy Clock: Punch" storage/logs/laravel.log | grep "$(date +%Y-%m-%d)" | wc -l
```

### Log Format:
```
[2025-12-09 08:30:15] local.INFO: Bundy Clock: Punch In recorded {
    "employee_id": 123,
    "employee_name": "Juan Dela Cruz",
    "timestamp": "2025-12-09 08:30:15",
    "is_late": false,
    "device_id": "BUNDY001"
}
```

---

## 🚀 Advanced Features

### 1. Multiple Bundy Clock Locations
Track which site employees punch in at:
```php
// Modify controller to store location
'location' => $request->device_id, // BUNDY001 = Main Office
```

### 2. Offline Sync
For unreliable internet connections:
- Bundy clock stores punches locally
- Syncs batch when connection restored
- Use `/api/bundy-clock/batch` endpoint

### 3. Real-time Dashboard
Show live punch activity:
- Use Laravel Websockets or Pusher
- Broadcast punch events
- Display on admin dashboard

---

## 📞 Support

### Getting Help:

1. **Check Logs First**
   - Location: `storage/logs/laravel.log`
   - Look for "Bundy Clock" entries

2. **Test Endpoints**
   - Use curl or Postman
   - Verify API responses

3. **Bundy Clock Vendor Support**
   - Contact manufacturer for device setup
   - Request API documentation
   - Ask about webhook/API capabilities

---

## ✅ Deployment Checklist

Before going live:

- [ ] Database migrations run
- [ ] Bundy clock routes added
- [ ] Employee IDs synchronized
- [ ] Test punch in/out working
- [ ] Logs monitoring setup
- [ ] HR validation workflow tested
- [ ] Backup plan for device failure
- [ ] Internet connectivity verified
- [ ] Security measures implemented
- [ ] Staff trained on new system

---

## 📝 Next Steps

1. **Immediate**: Test with one bundy clock device
2. **Week 1**: Deploy to main office
3. **Week 2**: Train HR staff on validation
4. **Week 3**: Roll out to all sites
5. **Ongoing**: Monitor logs and optimize

---

## 💡 Best Practices

1. **Always validate HR attendance** - Don't auto-approve
2. **Keep logs for audit trail** - Minimum 1 year
3. **Regular database backups** - Before/after major changes
4. **Test before deployment** - Use test endpoint first
5. **Have manual fallback** - Paper DTR as backup
6. **Monitor daily** - Check for sync issues

---

**Last Updated:** December 9, 2025
**Version:** 1.0
**Contact:** System Administrator
