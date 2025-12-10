# ✅ Bundy Clock Integration - Installation Checklist

## 🎯 Complete Setup in 15 Minutes

Follow this checklist to ensure everything is properly installed and working.

---

## Phase 1: Verify Installation (5 minutes)

### ✅ Files Created

Check that all files exist:

- [ ] `app/Http/Controllers/BundyClockController.php` ✓
- [ ] `app/Http/Middleware/BundyClockAuth.php` ✓
- [ ] `app/Console/Commands/ImportBundyClockCSV.php` ✓
- [ ] `config/bundy-clock.php` ✓
- [ ] `public/bundy-clock-test.html` ✓
- [ ] `routes/web.php` (updated) ✓
- [ ] `bootstrap/app.php` (updated) ✓

### ✅ Documentation Files

- [ ] `BUNDY_CLOCK_SUMMARY.md` ✓
- [ ] `BUNDY_CLOCK_INTEGRATION.md` ✓
- [ ] `BUNDY_CLOCK_QUICK_REFERENCE.md` ✓
- [ ] `BUNDY_CLOCK_VISUAL_GUIDE.md` ✓
- [ ] `README_BUNDY_CLOCK.md` ✓

---

## Phase 2: Test the System (5 minutes)

### Step 1: Start Your Server

```bash
# If using Laravel's built-in server
php artisan serve

# Or if using XAMPP
# Just make sure Apache & MySQL are running
```

### Step 2: Test Health Endpoint

Open browser and go to:
```
http://localhost/api/bundy-clock/health
```

**Expected Result:**
```json
{
    "status": "online",
    "timestamp": "2025-12-09 08:30:15",
    "message": "Bundy clock integration is operational"
}
```

- [ ] Health endpoint returns success ✓

### Step 3: Open Test Interface

Go to:
```
http://localhost/bundy-clock-test.html
```

- [ ] Test page loads correctly ✓
- [ ] No JavaScript errors in console ✓

### Step 4: Test Single Punch

On the test page:
1. Employee ID: `1` (or any existing employee ID)
2. Action: `Punch In`
3. Click "Send Punch"

**Expected Result:**
```json
{
    "success": true,
    "message": "Punch in recorded successfully",
    ...
}
```

- [ ] Punch in works ✓
- [ ] Success response received ✓

### Step 5: Verify Database

Run this query:
```sql
SELECT * FROM employee_attendance 
WHERE date = CURDATE() 
ORDER BY id DESC 
LIMIT 1;
```

- [ ] New record appears in database ✓
- [ ] `punch_in_time` is set ✓
- [ ] `attendance_status` is "On Site" ✓
- [ ] `validation_status` is "pending" ✓

---

## Phase 3: Configure Settings (3 minutes)

### Configure Attendance Times

Edit `config/bundy-clock.php` if needed:

```php
// What time should work start?
'scheduled_start_hour' => 8,      // 8:00 AM
'scheduled_start_minute' => 0,

// How many minutes grace period?
'grace_period_minutes' => 15,     // 15 minutes
```

- [ ] Configured start time ✓
- [ ] Configured grace period ✓

### Optional: Enable Security

Only do this AFTER testing works:

**Option A: IP Whitelist**

Add to `.env`:
```env
BUNDY_CLOCK_USE_IP_WHITELIST=true
```

Add to `config/bundy-clock.php`:
```php
'allowed_ips' => [
    '192.168.1.100',  // Your bundy clock IP
],
```

- [ ] IP whitelist configured (if using) ☐

**Option B: API Token**

Add to `.env`:
```env
BUNDY_CLOCK_USE_API_TOKEN=true
BUNDY_CLOCK_API_TOKEN=your-secret-token-here
```

- [ ] API token configured (if using) ☐

---

## Phase 4: Bundy Clock Configuration (2 minutes)

### Get Your Server URL

If local testing:
```
http://192.168.1.YOUR_PC_IP/api/bundy-clock/punch
```

If production:
```
https://your-domain.com/api/bundy-clock/punch
```

- [ ] Server URL identified ✓

### Configure Bundy Clock Device

Access your bundy clock admin panel and set:

1. **Network Settings**
   - [ ] WiFi/Ethernet connected ☐
   - [ ] Can ping your server ☐

2. **Server Settings**
   - [ ] URL: `http://your-server/api/bundy-clock/punch` ☐
   - [ ] Method: POST ☐
   - [ ] Format: JSON ☐
   - [ ] Content-Type: application/json ☐

3. **Data Mapping**
   - [ ] Badge Number → `employee_id` ☐
   - [ ] Timestamp → `timestamp` ☐
   - [ ] In/Out → `action` ☐

4. **Test Connection**
   - [ ] Bundy clock can reach server ☐
   - [ ] Test punch successful ☐

---

## Phase 5: Employee Setup (varies)

### Sync Employee IDs

For each employee:

1. Get employee ID from database:
   ```sql
   SELECT id, f_name, l_name FROM employee_list;
   ```

2. Register in bundy clock with same ID

3. Test:
   - [ ] Employee taps badge ☐
   - [ ] Bundy clock beeps ☐
   - [ ] Data appears in database ☐

**Progress:**
- [ ] 5 test employees registered ☐
- [ ] All test employees working ☐
- [ ] Ready for full deployment ☐

---

## Phase 6: HR Training (optional but recommended)

### Train HR Staff On:

- [ ] How to view pending validations ☐
- [ ] How to approve/reject attendance ☐
- [ ] What to do if errors occur ☐
- [ ] Emergency procedures ☐

---

## 🎉 Final Verification

### System Readiness Check

- [ ] ✅ Health endpoint returns success
- [ ] ✅ Test punches work correctly
- [ ] ✅ Database records created properly
- [ ] ✅ Bundy clock can reach server
- [ ] ✅ At least one employee tested successfully
- [ ] ✅ HR staff trained (or ready to train)
- [ ] ✅ Documentation reviewed
- [ ] ✅ Emergency contacts identified

### Production Readiness (if deploying live)

- [ ] ☐ Security enabled (IP whitelist or API token)
- [ ] ☐ HTTPS configured
- [ ] ☐ Database backups scheduled
- [ ] ☐ Log monitoring setup
- [ ] ☐ Paper DTR backup plan in place
- [ ] ☐ All employees registered
- [ ] ☐ Staff trained on new system

---

## 🐛 Troubleshooting

### If Health Check Fails

**Problem:** 404 Not Found

**Fix:**
```bash
# Clear route cache
php artisan route:clear
php artisan route:cache

# Try again
```

- [ ] Route cache cleared ☐

### If Test Punch Fails

**Problem:** Employee not found

**Fix:**
```sql
-- Check if employee exists
SELECT * FROM employee_list WHERE id = 1;

-- If not, use existing employee ID
-- Or create test employee
```

- [ ] Valid employee ID used ☐

### If Database Record Not Created

**Problem:** No entry in database

**Check:**
1. Database connection working?
2. Check logs: `storage/logs/laravel.log`
3. Any error messages?

- [ ] Logs checked ☐
- [ ] Error identified and fixed ☐

---

## 📊 Quick Test Script

Run all tests at once:

```bash
# 1. Check health
curl http://localhost/api/bundy-clock/health

# 2. Test punch in
curl -X POST http://localhost/api/bundy-clock/punch \
  -H "Content-Type: application/json" \
  -d '{"employee_id":"1","timestamp":"2025-12-09 08:30:00","action":"in"}'

# 3. Check database
php artisan tinker
>>> App\Models\EmployeeAttendance::whereDate('date', today())->latest()->first();
>>> exit

# All working? ✓
```

---

## 📞 Need Help?

### Common Issues & Solutions

| Issue | Solution | Checked |
|-------|----------|---------|
| 404 Error | Clear route cache | ☐ |
| Employee not found | Use valid employee ID | ☐ |
| Network error | Check firewall | ☐ |
| Already punched in | Use different employee or date | ☐ |

### Documentation

- **Quick Start:** `README_BUNDY_CLOCK.md`
- **Full Guide:** `BUNDY_CLOCK_INTEGRATION.md`
- **Visual Guide:** `BUNDY_CLOCK_VISUAL_GUIDE.md`
- **Quick Reference:** `BUNDY_CLOCK_QUICK_REFERENCE.md`

---

## ✅ Installation Complete!

If all items above are checked, your bundy clock integration is ready!

**Next Steps:**
1. ☐ Test with real bundy clock device
2. ☐ Register all employees
3. ☐ Train staff
4. ☐ Go live!

---

**Installation Date:** _______________  
**Installed By:** _______________  
**Tested By:** _______________  
**Status:** ☐ Testing  ☐ Production Ready  ☐ Live

---

**Version:** 1.0  
**Last Updated:** December 9, 2025
