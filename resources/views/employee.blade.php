<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Employee</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #16a34a;
            --white: #ffffff;

            --gray-500: #667085;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;

            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: var(--accent);
            --green-600: #059669;

            --black-1: #111827;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;

            --text-lg-medium-font-family: "Inter", sans-serif;
            --text-lg-medium-font-weight: 500;
            --text-lg-medium-font-size: 18px;
            --text-lg-medium-line-height: 28px;
            --text-md-normal-font-family: "Inter", sans-serif;
            --text-md-normal-font-weight: 400;
            --text-md-normal-font-size: 16px;
            --text-md-normal-line-height: 24px;
            --text-sm-medium-font-family: "Inter", sans-serif;
            --text-sm-medium-font-weight: 500;
            --text-sm-medium-font-size: 14px;
            --text-sm-medium-line-height: 20px;
            --text-headline-small-bold-font-family: "Inter", sans-serif;
            --text-headline-small-bold-font-weight: 700;
            --text-headline-small-bold-font-size: 18px;
            --text-headline-small-bold-line-height: 28px;
            --shadow-xs: 0 1px 2px rgba(16, 24, 40, 0.05);
            --shadow-md: 0 6px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: var(--text-md-normal-font-family);
            background-color: var(--main-bg);
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }



        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--header-bg), #16a34a);
            padding: 20px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        .header-menu {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .header-menu:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .header-title {
            color: white;
            font-family: "Zen Dots", sans-serif;
            font-size: 24px;
            font-weight: 400;
            flex: 1;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Employees Toolbar */
        .employee-header {
            background: white;
            border-radius: 12px;
            padding: 16px 16px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .employee-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 20px;
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .toolbar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
        }
        .search-box {
            position: relative;
            width: 320px;
            max-width: 40vw;
        }
        .search-box input {
            width: 100%;
            padding: 10px 14px 10px 36px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            outline: none;
            background-color: #fff;
        }
        .search-box .fa-search {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            font-size: 14px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #111827;
            cursor: pointer;
            box-shadow: var(--shadow-xs);
        }
        .btn:hover { background: #f9fafb; }
        .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
            color: #fff;
        }
        .btn-primary:hover { background: #1d4ed8; }

        /* Employee Cards */
        .employee-cards {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .employee-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
        }

        /* Form Layout */
        .form-wrapper {
            display: none;
            flex-direction: column;
            gap: 20px;
        }
        .form-header {
            background: white;
            border-radius: 12px;
            padding: 14px 16px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .back-btn {
            background: none;
            border: none;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            color: #111827;
        }
        .section-card {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
        }
        .section-title {
            color: #111827;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .section-note {
            color: #ef4444;
            font-size: 12px;
            margin-bottom: 12px;
        }
        .grid {
            display: grid;
            gap: 12px;
        }
        .grid.cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }
        .grid.cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .grid.cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid.cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .field label {
            font-size: 13px;
            color: #374151;
        }
        .field input, .field select {
            height: 36px;
            padding: 6px 10px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #ffffff;
            outline: none;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .btn-success { background: var(--accent); border-color: var(--accent); color: #fff; }
        .btn-success:hover { filter: brightness(0.95); }

        @media (max-width: 1024px) {
            .grid.cols-5, .grid.cols-4 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        .employee-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .employee-card-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-headline-small-bold-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .employee-expand {
            background: none;
            border: none;
            color: var(--gray-600);
            font-size: 16px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .employee-expand:hover {
            background-color: var(--gray-100);
        }

        /* Tables */
        .employee-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .employee-table thead {
            color: white;
        }

        .employee-table thead th {
            padding: 12px 16px;
            text-align: left;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
        }

        .employee-table tbody tr {
            border-bottom: 1px solid var(--gray-200);
        }

        .employee-table tbody tr:last-child {
            border-bottom: none;
        }

        .employee-table tbody td {
            padding: 12px 16px;
            color: var(--black-1);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
        }

        .employee-table.employees thead {
            background: var(--green-600);
        }
        .employee-table.employees thead th:first-child { border-top-left-radius: 8px; }
        .employee-table.employees thead th:last-child { border-top-right-radius: 8px; }
        .actions {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--gray-700);
        }
        .actions i { cursor: pointer; }

        .employee-table.attendance thead {
            background: var(--red-600);
        }

        /* Status badges */
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.on-leave {
            background: transparent;
            color: #92400e;
        }

        .status-badge.on-site {
            background: transparent;
            color: #065f46;
        }

        /* Responsive Design */
        @media (max-width: 768px) {


            .main-content {
                margin-left: 0;
            }

            .header {
                padding: 15px 20px;
            }

            .header-title {
                font-size: 20px;
            }

            .content-area {
                padding: 20px;
            }

            .employee-table {
                font-size: 14px;
            }

            .employee-table thead th,
            .employee-table tbody td {
                padding: 8px 12px;
            }

            .employee-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Header -->
            <header class="header">
                <button class="header-menu" id="headerMenu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <!-- Content Area -->
            <section class="content-area">
                <!-- Employees Toolbar -->
                <div class="employee-header">
                    <h1 class="employee-title">Employees</h1>
                    <div class="toolbar">
                        <button class="btn" title="Options"><i class="fas fa-ellipsis-v"></i></button>
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search" />
                        </div>
                        <button class="btn" title="Filters"><i class="fas fa-filter"></i> Filters</button>
                        <button class="btn btn-primary" title="Add Employee"><i class="fas fa-user-plus"></i> Add Employee</button>
                    </div>
                </div>

                <div class="employee-cards">
                        <div class="employee-list-section">
                            <!-- Employees Table Card -->
                            <div class="employee-card">
                                <div class="employee-card-header">
                                    <h2 class="employee-card-title">List of Employees</h2>
                                    <button class="employee-expand"><i class="fas fa-expand-arrows-alt"></i></button>
                                </div>
                                <table class="employee-table employees">
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>User ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Position</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>EMP002</td>
                                            <td>PRM002</td>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>Project Manager</td>
                                            <td>
                                                <span class="actions">
                                                    <i class="far fa-eye" title="View"></i>
                                                    <i class="far fa-edit" title="Edit"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EMP001</td>
                                            <td>-</td>
                                            <td>Mari</td>
                                            <td>Lou</td>
                                            <td>Construction Worker</td>
                                            <td>
                                                <span class="actions">
                                                    <i class="far fa-eye" title="View"></i>
                                                    <i class="far fa-edit" title="Edit"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-wrapper employee-form-section" id="employeeFormSection">
                            <div class="form-header">
                                <button class="back-btn" id="backToList"><i class="fas fa-arrow-left"></i></button>
                                <h2 class="employee-card-title" id="formTitle">Add Employee</h2>
                            </div>

                            <div class="section-card">
                                <div class="section-title">Employee Information</div>
                                <div class="section-note">Fields marked (*) are required</div>
                                <div class="grid cols-5">
                                    <div class="field"><label>Employee ID *</label><input id="emp_employee_id" type="text"></div>
                                    <div class="field"><label>User ID (if applicable)</label><input id="emp_user_id" type="text"></div>
                                    <div class="field"><label>Position *</label><input id="emp_position" type="text"></div>
                                    <div class="field"><label>Phone No. *</label><input id="emp_phone" type="text"></div>
                                    <div class="field"><label>Email Address *</label><input id="emp_email" type="email"></div>
                                </div>
                                <div class="grid cols-5" style="margin-top:12px;">
                                    <div class="field"><label>Title</label><input id="emp_title" type="text"></div>
                                    <div class="field"><label>First Name *</label><input id="emp_first_name" type="text"></div>
                                    <div class="field"><label>Middle Name</label><input id="emp_middle_name" type="text"></div>
                                    <div class="field"><label>Last Name *</label><input id="emp_last_name" type="text"></div>
                                    <div class="field"><label>Suffix</label><input id="emp_suffix" type="text"></div>
                                </div>
                                <div class="grid cols-5" style="margin-top:12px;">
                                    <div class="field"><label>Date of Birth *</label><input id="emp_dob" type="date"></div>
                                    <div class="field"><label>Gender *</label>
                                        <select id="emp_gender"><option value="">Select</option><option>Male</option><option>Female</option><option>Other</option></select>
                                    </div>
                                    <div class="field"><label>Birth Country *</label><input id="emp_birth_country" type="text"></div>
                                    <div class="field"><label>Birth State</label><input id="emp_birth_state" type="text"></div>
                                    <div class="field"><label>Birth Location *</label><input id="emp_birth_location" type="text"></div>
                                </div>
                            </div>

                            <div class="section-card">
                                <div class="section-title">Address Details</div>
                                <div class="section-note">Fields marked (*) are required</div>
                                <div class="grid cols-4">
                                    <div class="field"><label>Address Line 1 *</label><input id="emp_addr1" type="text"></div>
                                    <div class="field"><label>Address Line 2</label><input id="emp_addr2" type="text"></div>
                                    <div class="field"><label>City / Municipality *</label><input id="emp_city" type="text"></div>
                                    <div class="field"><label>Province / State *</label><input id="emp_state" type="text"></div>
                                </div>
                                <div class="grid cols-4" style="margin-top:12px;">
                                    <div class="field"><label>ZIP / Postal Code *</label><input id="emp_zip" type="text"></div>
                                    <div class="field"><label>Country *</label><input id="emp_country" type="text"></div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button class="btn" id="cancelForm">Cancel</button>
                                <button class="btn btn-success" id="saveForm">Save</button>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>

        @include('partials.sidebar-js')
        <script>
            (function(){
                const addBtn = document.querySelector('.btn.btn-primary');
                const listSection = document.querySelector('.employee-list-section');
                const formSection = document.getElementById('employeeFormSection');
                const backBtn = document.getElementById('backToList');
                const cancelBtn = document.getElementById('cancelForm');
                const formTitle = document.getElementById('formTitle');

                function showForm(mode){
                    formTitle.textContent = mode === 'edit' ? 'Edit Employee' : 'Add Employee';
                    listSection.style.display = 'none';
                    formSection.style.display = 'flex';
                }
                function showList(){
                    formSection.style.display = 'none';
                    listSection.style.display = 'block';
                }
                function clearForm(){
                    formSection.querySelectorAll('input').forEach(i=> i.value = '');
                    const g = document.getElementById('emp_gender'); if(g) g.value = '';
                }
                function fillFromRow(tr){
                    const tds = tr.querySelectorAll('td');
                    document.getElementById('emp_employee_id').value = tds[0]?.textContent.trim() || '';
                    document.getElementById('emp_user_id').value = tds[1]?.textContent.trim() || '';
                    document.getElementById('emp_first_name').value = tds[2]?.textContent.trim() || '';
                    document.getElementById('emp_last_name').value = tds[3]?.textContent.trim() || '';
                    document.getElementById('emp_position').value = tds[4]?.textContent.trim() || '';
                }

                if(addBtn){ addBtn.addEventListener('click', ()=>{ clearForm(); showForm('add'); }); }
                if(backBtn){ backBtn.addEventListener('click', showList); }
                if(cancelBtn){ cancelBtn.addEventListener('click', (e)=>{ e.preventDefault(); showList(); }); }

                document.querySelectorAll('.actions .fa-edit').forEach(icon=>{
                    icon.addEventListener('click', (e)=>{
                        const tr = e.target.closest('tr');
                        clearForm();
                        fillFromRow(tr);
                        showForm('edit');
                    });
                });
            })();
        </script>
    </body>

    </html>
