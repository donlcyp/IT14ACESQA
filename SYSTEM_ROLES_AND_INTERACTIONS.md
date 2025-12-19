# System Roles and Interactions

This document summarizes the main **user roles** in the system and how they interact with the application (key pages, routes, and responsibilities). It is based on the current navigation structure and attendance-related features.

---

## Overview of Roles

- **OWNER**  
  Business owner / system owner with full management capabilities.

- **PM (Project Manager)**  
  Manages projects and oversees attendance for project staff.

- **SS (Site Supervisor)**  
  Manages on-site operations, issues, and verifies attendance for workers on their site.

- **HR (Timekeeper / HR)**  
  Validates attendance records, manages approvals/rejections, and may have their own attendance.

- **FM (Finance Manager)**  
  Oversees financial dashboards and material replacement approvals.

- **QA (Quality Assurance)**  
  Handles QA inspection of materials.

- **CW (Construction Worker)**  
  On-site worker with access to their own dashboard and attendance.

- **General Employee**  
  Any non-OWNER/non-SS/non-CW/non-HR/non-FM user who has an employee profile and can view their own attendance.

---

## OWNER

**Role key:** `OWNER`

**Primary responsibilities**

- Full visibility and control over projects.
- Access to attendance overview for employees.
- Management of personnel, salary settings, and system logs.

**Main navigation / routes**

- **Projects**  
  `route('projects')`  
  View and manage projects.

- **Archives**  
  `route('archives')`  
  View archived projects.

- **Attendance**  
  `route('employee-attendance')`  
  View attendance records (overview for employees/projects).

- **Personnel**  
  `route('admin.users.index')`  
  Manage system users and personnel records.

- **Activity Logs**  
  `route('logs.index')`  
  View system activity / audit logs.

- **Salary Settings**  
  `route('settings.salary-rates')`  
  Configure salary-related settings.

- **Finance Graphs**  
  `route('finance-graphs')`  
  View financial dashboards and graphs.

**Key attendance interactions**

- Uses the **Owner / PM Attendance** interface at `employee-attendance` to review and analyze attendance across employees and projects.

---

## Project Manager (PM)

**Role key:** `PM`

**Primary responsibilities**

- Manage active and archived projects.
- Monitor and review attendance at the project level.

**Main navigation / routes**

- **Projects**  
  `route('projects')`

- **Archives**  
  `route('archives')`

- **Attendance**  
  `route('employee-attendance')`  
  View attendance overview (similar to Owner view).

- **Attendance History**  
  `route('employee-attendance.history')`  
  Access historical attendance records.

**Key attendance interactions**

- Reviews attendance and history for employees.
- Works with HR and Site Supervisors when discrepancies appear.

---

## Site Supervisor (SS)

**Role key:** `SS`

**Primary responsibilities**

- Oversee on-site project execution.
- Report daily progress and issues.
- Verify attendance for workers on their assigned project.

**Main navigation / routes**

- **SS Dashboard**  
  `route('ss.dashboard')`  
  Overview of assigned project(s) and site metrics.

- **My Projects**  
  `route('ss.projects')` and `route('ss.project-view')`  
  View assigned projects and their details.

- **Daily Progress**  
  `route('ss.progress-reports')`  
  Manage and view daily project progress reports and tasks.

- **Issues & Incidents**  
  `route('ss.issues')`  
  Create and track issues or incident reports from the site.

- **Attendance Verify**  
  `route('ss.attendance')`  
  Access the attendance verification screen for employees assigned to the Site Supervisor's project.

- **My Attendance**  
  `route('my-attendance')`  
  View the Site Supervisor's own attendance history and statistics.

**Key attendance interactions**

- Verifies employee punch-ins for their project via the **Attendance Verification** page.
- Can see their **own attendance** via `my-attendance` (uses shared employee attendance view logic).

---

## HR / Timekeeper

**Role key:** `HR`

**Primary responsibilities**

- Validate and audit attendance submissions.
- Approve or reject individual attendance records.
- Monitor pending, approved, and rejected attendance.

**Main navigation / routes**

- **HR Dashboard**  
  `route('attendance-validation.dashboard')`  
  High-level stats and quick links for validation work.

- **Pending Reviews**  
  `route('attendance-validation.index')`  
  List of attendance entries awaiting HR validation.

- **Approved**  
  `route('attendance-validation.approved')`

- **Rejected**  
  `route('attendance-validation.rejected')`

- **My Attendance** (optional, if HR user has an EmployeeList profile)  
  `route('my-attendance')`

**Key attendance interactions**

- Uses the **Attendance Validation** flow:
  - `index` view to filter and pick records.
  - `show` view to review individual entries with context and history.
  - Approve / reject via the validation forms.

---

## Finance Manager (FM)

**Role key:** `FM`

**Primary responsibilities**

- Monitor financial performance and approvals related to material replacements.

**Main navigation / routes**

- **Finance Dashboard**  
  `route('fm.dashboard')`

- **Replacement Approvals**  
  `route('fm.replacement-approvals')`  
  Review and approve/deny material replacement requests. The menu shows a badge for pending requests.

**Key attendance interactions**

- No direct attendance management (focus is on financial impact and approvals).

---

## Quality Assurance (QA)

**Role key:** `QA`

**Primary responsibilities**

- Inspect and validate materials used on projects.

**Main navigation / routes**

- **QA Materials**  
  `route('qa.materials')`  
  QA-specific interface for reviewing and updating material inspection status.

**Key attendance interactions**

- No direct attendance screens; interaction is via material QA workflows.

---

## Construction Worker (CW)

**Role key:** `CW`

**Primary responsibilities**

- Access personal dashboard and view their own attendance.

**Main navigation / routes**

- **Dashboard**  
  `route('cw.dashboard')`

- **My Attendance**  
  `route('cw.attendance')`  
  Worker-focused attendance view.

**Key attendance interactions**

- Views their **own attendance** via the CW-specific attendance page.
- Punch-in / punch-out logic is handled by the attendance subsystem (not detailed here).

---

## General Employee (non-OWNER / non-SS / non-CW / non-HR / non-FM)

**Role detection:**

- Authenticated user **not** in roles: `OWNER`, `SS`, `CW`, `HR`, `FM`, and
- Has a corresponding record in `EmployeeList`.

**Primary responsibilities**

- Limited system access, with focus on viewing their own attendance.

**Main navigation / routes**

- **My Attendance**  
  `route('my-attendance')`  
  Employee-facing attendance page showing:
  - Todays attendance (if any)
  - Recent records
  - Attendance statistics (total days, on-site, on-leave, absent, late count)

**Key attendance interactions**

- Can monitor their own attendance and history.
- Does not manage other employees attendance.

---

## Notes

- The **sidebar navigation** is the primary source of truth for which pages each role can access.
- Attendance-related logic is centralized mainly in:
  - `EmployeeAttendanceController` (employee views + Owner/PM overviews),
  - HR **attendance validation** controllers and views,
  - Site Supervisor **attendance verification** methods.
- This document is intended as a high-level map; for detailed request/response flows, refer to the specific controller and route documentation.
