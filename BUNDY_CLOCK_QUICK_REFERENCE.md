# 📋 Bundy Clock Quick Reference Card

## For System Administrators

### 🚀 Quick Start (5 Minutes)

1. **Access Test Page**
   ```
   http://localhost/bundy-clock-test.html
   ```

2. **Test Health Check**
   - Click "Check System Health"
   - Should return: `{"status": "online"}`

3. **Test Punch In**
   - Employee ID: `1`
   - Action: `Punch In`
   - Click "Send Punch"

4. **Verify Database**
   ```sql
   SELECT * FROM employee_attendance 
   WHERE date = CURDATE() 
   ORDER BY id DESC LIMIT 5;
   ```

---

## For Bundy Clock Configuration

### Required Settings

| Setting | Value |
|---------|-------|
| **Server URL** | `http://your-domain.com/api/bundy-clock/punch` |
| **Method** | POST |
| **Content-Type** | application/json |
| **Data Format** | JSON |

### JSON Format
```json
{
    "employee_id": "BADGE_NUMBER",
    "timestamp": "YYYY-MM-DD HH:MM:SS",
    "action": "in" or "out",
    "device_id": "DEVICE_NAME"
}
```

---

## For Employees

### How to Clock In/Out

1. **Arrive at Work**
   - Place your badge/finger on bundy clock
   - Wait for confirmation beep
   - Check display shows your name

2. **Leave Work**
   - Place your badge/finger on bundy clock again
   - Wait for confirmation beep
   - You're clocked out!

### What if it doesn't work?

- **Red light or error**: Contact HR/Timekeeper
- **No beep**: Try again
- **Wrong employee shown**: Contact IT immediately

---

## For HR/Timekeeper

### Daily Checklist

**Morning (8:30 AM)**
- [ ] Check all employees clocked in
- [ ] Verify no duplicate entries
- [ ] Note any late arrivals

**Afternoon (5:30 PM)**
- [ ] Check all employees clocked out
- [ ] Validate attendance records
- [ ] Approve/reject pending records

**Weekly**
- [ ] Review bundy clock logs
- [ ] Check for sync issues
- [ ] Generate attendance reports

### Validation Workflow

1. Go to **Attendance Validation** page
2. Review pending punches
3. Check if employee was actually on-site
4. Click **Approve** or **Reject** with reason
5. Done!

---

## Troubleshooting

### Employee Can't Punch In

**Check:**
1. Is employee registered in system?
2. Does badge number match database?
3. Is bundy clock online?
4. Has employee already punched in today?

**Fix:**
- Manual entry by HR/Timekeeper
- Re-register badge if needed

### No Data in Database

**Check:**
1. Is bundy clock connected to network?
2. Test health endpoint: `/api/bundy-clock/health`
3. Check Laravel logs: `storage/logs/laravel.log`
4. Verify API endpoint configured correctly

**Fix:**
- Restart bundy clock device
- Check network connectivity
- Contact IT support

### Multiple Punch-Ins

**Cause:** Employee tapped badge multiple times

**Fix:**
- HR can delete duplicate entries
- Educate employee to wait for confirmation

---

## API Endpoints Reference

| Endpoint | Purpose | When Used |
|----------|---------|-----------|
| `POST /api/bundy-clock/punch` | Single punch | Real-time sync |
| `POST /api/bundy-clock/batch` | Multiple punches | Periodic sync |
| `GET /api/bundy-clock/health` | System check | Monitoring |
| `POST /api/bundy-clock/test` | Testing | Setup only |

---

## Security Notes

### IP Whitelist (Recommended)

Add to `.env`:
```env
BUNDY_CLOCK_USE_IP_WHITELIST=true
```

Add to `config/bundy-clock.php`:
```php
'allowed_ips' => [
    '192.168.1.100', // Main office bundy clock
    '192.168.1.101', // Site A bundy clock
],
```

### API Token (Alternative)

Add to `.env`:
```env
BUNDY_CLOCK_USE_API_TOKEN=true
BUNDY_CLOCK_API_TOKEN=your-secret-token-here
```

Configure bundy clock to send:
```
Authorization: Bearer your-secret-token-here
```

---

## Common Scenarios

### Scenario 1: New Employee
1. Add employee to database
2. Note their `employee_id` (e.g., 123)
3. Register in bundy clock with same ID
4. Test punch in/out
5. Done!

### Scenario 2: Lost Badge
1. Employee reports to HR
2. HR issues temporary badge
3. Update bundy clock with temp badge number
4. Order new permanent badge
5. Update system when new badge arrives

### Scenario 3: Device Offline
1. Bundy clock stores punches locally
2. When online, syncs automatically
3. Or use batch upload endpoint
4. HR validates after sync

### Scenario 4: Wrong Punch
1. Employee realizes error
2. Reports to HR immediately
3. HR can edit in system
4. Document reason for change

---

## Support Contacts

| Issue | Contact |
|-------|---------|
| Badge not working | HR/Timekeeper |
| Device offline | IT Support |
| Database issues | System Admin |
| New employee setup | HR Department |

---

## Maintenance Schedule

### Daily
- Check logs for errors
- Verify all punches recorded

### Weekly
- Backup database
- Review system health logs

### Monthly
- Update employee list
- Clean old logs
- Check device firmware

---

## Quick Commands

### View Recent Punches
```bash
tail -n 50 storage/logs/laravel.log | grep "Bundy Clock"
```

### Count Today's Punches
```sql
SELECT COUNT(*) FROM employee_attendance 
WHERE date = CURDATE();
```

### List Employees Not Punched In
```sql
SELECT * FROM employee_list 
WHERE id NOT IN (
    SELECT employee_id FROM employee_attendance 
    WHERE date = CURDATE()
);
```

---

**Last Updated:** December 9, 2025  
**Version:** 1.0  
**For Questions:** Contact IT Department
