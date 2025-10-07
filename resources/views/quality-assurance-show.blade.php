<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Quality Assurance</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --gray-500: #667085;
            --white: #ffffff;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --blue-1: #1c57b6;
            --blue-600: #2563eb;
            --red-600: #dc2626;
            --black-1: #313131;
            --sidebar-bg: #c4c4c4;
            --header-bg: #4a5568;
            --main-bg: #e2e8f0;
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

        * { box-sizing: border-box; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }

        body { font-family: var(--text-md-normal-font-family); background-color: var(--main-bg); overflow-x: hidden; }

        .dashboard-container { display: flex; min-height: 100vh; }

        .sidebar { width: 280px; background-color: var(--sidebar-bg); padding: 20px; display: flex; flex-direction: column; gap: 30px; position: fixed; height: 100vh; left: 0; top: 0; z-index: 1000; transition: transform 0.3s ease; }
        .sidebar.collapsed { transform: translateX(-100%); }
        .sidebar-header { display: flex; align-items: center; gap: 15px; margin-bottom: 10px; }
        .logo { width: 50px; height: 50px; border-radius: 50%; background-color: white; border: 2px solid #9ca3af; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .logo-img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; display:block; }
        .logo-fallback { width:100%; height:100%; border-radius:50%; display:none; align-items:center; justify-content:center; background:#e5e7eb; color:#111827; font-weight:700; font-family: "Inter", sans-serif; }
        .sidebar-title { font-family: var(--text-headline-small-bold-font-family); font-size: var(--text-headline-small-bold-font-size); font-weight: var(--text-headline-small-bold-font-weight); color: black; }
        .nav-toggle { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .hamburger-menu { background: none; border: none; font-size: 18px; color: var(--gray-700); cursor: pointer; }
        .chevron { font-size: 14px; color: var(--gray-700); }
        .nav-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; }
        .nav-item { display: flex; align-items: center; gap: 15px; padding: 12px 16px; border-radius: 8px; text-decoration: none; color: var(--gray-700); font-family: var(--text-md-normal-font-family); font-size: var(--text-md-normal-font-size); transition: all 0.2s ease; position: relative; }
        .nav-item:hover { background-color: rgba(255, 255, 255, 0.3); }
        .nav-item.active { background-color: white; color: black; font-weight: 600; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
        .nav-icon { font-size: 18px; width: 20px; text-align: center; }
        .logout-section { margin-top: auto; padding-top: 20px; }
        .logout-item { display: flex; align-items: center; gap: 15px; padding: 12px 16px; border-radius: 8px; text-decoration: none; color: var(--gray-700); font-family: var(--text-md-normal-font-family); font-size: var(--text-md-normal-font-size); transition: all 0.2s ease; }
        .logout-item:hover { background-color: rgba(255, 255, 255, 0.3); }

        .main-content { flex: 1; margin-left: 280px; display: flex; flex-direction: column; min-height: 100vh; }
        .main-content.expanded { margin-left: 0; }

        .header { background: linear-gradient(135deg, var(--header-bg), #2d3748); padding: 20px 30px; display: flex; align-items: center; gap: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); position: relative; overflow: hidden; }
        .header::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent); }
        .header-menu { background: none; border: none; color: white; font-size: 24px; cursor: pointer; padding: 8px; border-radius: 4px; transition: background-color 0.2s ease; }
        .header-menu:hover { background-color: rgba(255, 255, 255, 0.1); }
        .header-title { color: white; font-family: "Zen Dots", sans-serif; font-size: 24px; font-weight: 400; flex: 1; }

        .content-area { flex: 1; padding: 30px; background: linear-gradient(135deg, #f7fafc, #edf2f7); border-left: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; }

        .qa-header { background: #f5f5f5; border-radius: 10px; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25); margin-bottom: 30px; padding: 20px; }
        .qa-content { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
        .qa-title-section { flex: 1; display: flex; flex-direction: column; gap: 12px; }
        .project-card { background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; padding:14px; box-shadow: var(--shadow-xs); }
        .project-line-1 { display:flex; align-items:center; gap:8px; }
        .project-title-input { flex:1; background:#f7f7f7; border:1px solid #e5e7eb; border-radius:6px; padding:8px 12px; color:#111827; font-weight:600; }
        .project-subrow { margin-top:8px; display:flex; align-items:center; gap:10px; color:#6b7280; font-size:12px; }
        .inspector-chip { background:#e5e7eb; border-radius:6px; padding:4px 8px; color:#111827; font-size:12px; }
        .qa-title { color: #101828; font-family: var(--text-lg-medium-font-family); font-size: var(--text-lg-medium-font-size); font-weight: var(--text-lg-medium-font-weight); line-height: var(--text-lg-medium-line-height); }
        .qa-actions { display: flex; align-items: center; gap: 16px; }
        .qa-button { background: none; border: none; cursor: pointer; }
        .qa-button-base { display: inline-flex; align-items: center; gap:6px; padding: 8px 12px; border-radius: 8px; background: #fff; box-shadow: var(--shadow-xs); border:1px solid #e5e7eb; font-size: 12px; }
        .qa-button-base.primary { background:#3b82f6; color:#fff; border-color:#3b82f6; }
        .qa-button-base.success { background:#22c55e; color:#fff; border-color:#22c55e; }
        .qa-button-base.danger { background:#ef4444; color:#fff; border-color:#ef4444; }
        .qa-filter-base { background: #ffffff; border-radius: 8px; padding: 10px 16px; display: flex; align-items: center; gap: 8px; box-shadow: var(--shadow-xs); }
        .qa-filter-icon { font-size: 16px; color: #344054; }
        .qa-filter-text { color: #344054; font-family: var(--text-sm-medium-font-family); font-size: var(--text-sm-medium-font-size); font-weight: var(--text-sm-medium-font-weight); line-height: var(--text-sm-medium-line-height); }

        .project-chip { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; background:#fff; border:1px solid var(--gray-300); border-radius:8px; box-shadow: var(--shadow-xs); }
        .project-badge { width:20px; height:20px; border-radius:50%; }
        .project-title { font-weight:600; color:#111827; }
        .project-sub { color:#6b7280; font-size:12px; }

        .table-card { background:#ffffff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow:hidden; border:1px solid #e2e8f0; }
        table { width: 100%; border-collapse: collapse; }
        thead th { background:#f8fafc; color:#111827; font-weight:600; padding:12px; border-bottom:1px solid #e5e7eb; font-size:12px; }
        tbody td { padding:12px; border-bottom:1px solid #e5e7eb; font-size:12px; color:#111827; }
        tbody tr.selected { background:#eef2ff; }
        tbody tr.delete-hover { background:#fee2e2; }

        /* Modal Styles (reused pattern) */
        .qa-modal { display:none; position:fixed; inset:0; background: rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index: 2000; opacity:0; transition: opacity .2s ease; }
        .qa-modal.active { display:flex; opacity:1; }
        .qa-modal-content { background:#ffffff; border:1px solid #e5e7eb; border-radius:10px; width:100%; max-width:720px; padding:20px; position:relative; box-shadow: var(--shadow-md); }
        .qa-modal-title { font-weight:700; margin-bottom:12px; color:#111827; }
        .qa-form-grid { display:grid; grid-template-columns: 1fr 1fr; gap:12px; }
        .qa-form-field { display:flex; flex-direction:column; gap:6px; }
        .qa-label { font-size:12px; color:#374151; }
        .qa-input, .qa-select { border:1px solid #e5e7eb; border-radius:6px; padding:8px 10px; font-size:14px; }
        .qa-actions-row { display:flex; justify-content:flex-end; gap:8px; margin-top:16px; }
        .btn-sm { display:inline-flex; align-items:center; gap:6px; padding:8px 12px; border-radius:8px; border:1px solid #e5e7eb; background:#fff; cursor:pointer; }
        .btn-sm.primary { background:#3b82f6; color:#fff; border-color:#3b82f6; }
        .btn-sm.ghost { background:#fff; color:#111827; }
        .modal-close { position:absolute; top:10px; right:10px; background:#fff; border:1px solid #e5e7eb; border-radius:6px; padding:6px; cursor:pointer; }

        @media (max-width: 768px) {
            .sidebar { width: 100%; transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .content-area { padding: 20px; }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="{{ asset('images/aces-logo.png') }}" alt="ACES logo" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="logo-fallback">ACES</div>
                </div>
                <div class="sidebar-title">ACES</div>
            </div>
            <div class="nav-toggle">
                <button class="hamburger-menu" id="navToggle"><i class="fas fa-bars"></i></button>
                <span class="chevron"><i class="fas fa-chevron-right"></i></span>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('dashboard') }}" class="nav-item"><i class="nav-icon fas fa-smile"></i><span>Dashboard</span></a>
                <a href="{{ route('quality-assurance') }}" class="nav-item active"><i class="nav-icon fas fa-bolt"></i><span>Quality Assurance</span></a>
                <a href="{{ route('audit') }}" class="nav-item"><i class="nav-icon fas fa-gavel"></i><span>Audit</span></a>
                <a href="{{ route('finance') }}" class="nav-item"><i class="nav-icon fas fa-chart-bar"></i><span>Finance</span></a>
                <a href="{{ route('projects') }}" class="nav-item"><i class="nav-icon fas fa-tasks"></i><span>Projects</span></a>
                <a href="{{ route('employee-attendance') }}" class="nav-item"><i class="nav-icon fas fa-hard-hat"></i><span>Employee Attendance</span></a>
            </nav>
            <div class="logout-section">
                <a href="#" class="logout-item"><i class="nav-icon fas fa-sign-out-alt"></i><span>Log Out</span></a>
            </div>
        </aside>

        <main class="main-content" id="mainContent">
            <header class="header">
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
                <button class="header-menu" id="headerMenu"><i class="fas fa-bars"></i></button>
            </header>

            <section class="content-area">
                <div class="qa-header">
                    <div class="qa-content">
                        <div class="qa-title-section">
                            <div class="project-card">
                                <div class="project-line-1">
                                    <span class="project-badge" style="background: {{ $record->color }}"></span>
                                    <div class="project-title-input">{{ $record->title }}</div>
                                </div>
                                <div class="project-subrow">
                                    <span>Mr. {{ $record->client }}</span>
                                    <span>•</span>
                                    <span>Inspected by:</span>
                                    <span class="inspector-chip">{{ $record->inspector }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="qa-actions">
                            <a href="{{ route('quality-assurance') }}" class="qa-button" aria-label="Back">
                                <div class="qa-button-base"><i class="fas fa-arrow-left"></i><span>Back</span></div>
                            </a>
                            <button class="qa-button" aria-label="New">
                                <div class="qa-button-base primary" onclick="openMaterialModal('new')"><i class="fas fa-plus"></i><span>New</span></div>
                            </button>
                            <button class="qa-button" aria-label="Edit">
                                <div class="qa-button-base success" onclick="openMaterialModal('edit')"><i class="fas fa-pen"></i><span>Edit</span></div>
                            </button>
                            <button class="qa-button" aria-label="Delete">
                                <div class="qa-button-base danger" id="deleteBtn"><i class="fas fa-trash"></i><span>Delete</span></div>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-card">
                    <table>
                        <thead>
                            <tr>
                                <th>Material Name</th>
                                <th>Batch/Serial No.</th>
                                <th>Supplier</th>
                                <th>Quantity Received</th>
                                <th>Unit of Measure</th>
                                <th>Unit Price (₱)</th>
                                <th>Total Cost (₱)</th>
                                <th>Date Received</th>
                                <th>Date Inspected</th>
                                <th>Status</th>
                                <th>Storage Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="11" style="color:#6b7280;">No materials yet. Use New to add a material.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- New/Edit Material Modal -->
                <div class="qa-modal" id="materialModal" aria-hidden="true">
                    <div class="qa-modal-content" role="dialog" aria-modal="true">
                        <button class="modal-close" onclick="closeMaterialModal()"><i class="fas fa-times"></i></button>
                        <h3 class="qa-modal-title" id="materialModalTitle">New Material</h3>
                        <form id="materialForm">
                            <div class="qa-form-grid">
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_name">Material Name</label>
                                    <input class="qa-input" id="mat_name" name="material_name" placeholder="e.g., PVC Pipe 4\"" />
                                </div>
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_batch">Batch/Serial No.</label>
                                    <input class="qa-input" id="mat_batch" name="batch_serial" placeholder="e.g., PVC-2025-045" />
                                </div>
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_supplier">Supplier</label>
                                    <input class="qa-input" id="mat_supplier" name="supplier" placeholder="e.g., Solid Steel Philippines" />
                                </div>
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_qty">Quantity Received</label>
                                    <input class="qa-input" id="mat_qty" name="quantity" type="number" min="0" value="0" />
                                </div>
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_uom">Unit of Measure</label>
                                    <input class="qa-input" id="mat_uom" name="uom" placeholder="e.g., Meter, Piece" />
                                </div>
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_price">Unit Price (₱)</label>
                                    <input class="qa-input" id="mat_price" name="unit_price" type="number" step="0.01" min="0" value="0" />
                                </div>
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_total">Total Cost (₱)</label>
                                    <input class="qa-input" id="mat_total" name="total_cost" type="number" step="0.01" min="0" value="0" readonly />
                                </div>
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_received">Date Received</label>
                                    <input class="qa-input" id="mat_received" name="date_received" type="date" />
                                </div>
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_inspected">Date Inspected</label>
                                    <input class="qa-input" id="mat_inspected" name="date_inspected" type="date" />
                                </div>
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_status">Status</label>
                                    <select class="qa-select" id="mat_status" name="status">
                                        <option>Pending</option>
                                        <option>Pass</option>
                                        <option>Fail</option>
                                    </select>
                                </div>
                                <div class="qa-form-field">
                                    <label class="qa-label" for="mat_location">Storage Location</label>
                                    <input class="qa-input" id="mat_location" name="storage_location" placeholder="e.g., Site A" />
                                </div>
                            </div>
                            <div class="qa-actions-row">
                                <button type="button" class="btn-sm ghost" onclick="closeMaterialModal()">Cancel</button>
                                <button type="submit" class="btn-sm primary" id="materialSubmitBtn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        const headerMenu = document.getElementById('headerMenu');
        const navToggle = document.getElementById('navToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        function toggleSidebar() { sidebar.classList.toggle('collapsed'); mainContent.classList.toggle('expanded'); }
        headerMenu && headerMenu.addEventListener('click', toggleSidebar);
        navToggle && navToggle.addEventListener('click', toggleSidebar);

        // Row selection (for edit)
        const tableBody = document.querySelector('tbody');
        let selectedRowIndex = -1;
        tableBody.addEventListener('click', (e) => {
            const row = e.target.closest('tr');
            if (!row || row.querySelector('td[colspan]')) return;
            Array.from(tableBody.querySelectorAll('tr')).forEach(r => r.classList.remove('selected'));
            row.classList.add('selected');
            selectedRowIndex = Array.from(tableBody.children).indexOf(row);
        });

        // Delete hover behavior
        const deleteBtn = document.getElementById('deleteBtn');
        function setDeleteHover(active) {
            if (selectedRowIndex >= 0) {
                const row = tableBody.children[selectedRowIndex];
                row.classList.toggle('delete-hover', active);
            }
        }
        deleteBtn && deleteBtn.addEventListener('mouseenter', () => setDeleteHover(true));
        deleteBtn && deleteBtn.addEventListener('mouseleave', () => setDeleteHover(false));

        // Delete confirmation
        deleteBtn && deleteBtn.addEventListener('click', () => {
            if (selectedRowIndex < 0) return;
            const row = tableBody.children[selectedRowIndex];
            const materialName = row.children[0].textContent.trim();
            const ok = confirm(`Are you sure to delete ${materialName}?`);
            if (ok) {
                row.remove();
                selectedRowIndex = -1;
            } else {
                setDeleteHover(false);
            }
        });

        // Modal logic
        const materialModal = document.getElementById('materialModal');
        const materialForm = document.getElementById('materialForm');
        const modalTitle = document.getElementById('materialModalTitle');
        const submitBtn = document.getElementById('materialSubmitBtn');

        function openMaterialModal(mode) {
            modalTitle.textContent = mode === 'edit' ? 'Update Material' : 'New Material';
            submitBtn.textContent = mode === 'edit' ? 'Update' : 'Save';

            if (mode === 'edit' && selectedRowIndex >= 0) {
                const cells = tableBody.children[selectedRowIndex].children;
                document.getElementById('mat_name').value = cells[0].textContent.trim();
                document.getElementById('mat_batch').value = cells[1].textContent.trim();
                document.getElementById('mat_supplier').value = cells[2].textContent.trim();
                document.getElementById('mat_qty').value = cells[3].textContent.trim();
                document.getElementById('mat_uom').value = cells[4].textContent.trim();
                document.getElementById('mat_price').value = cells[5].textContent.replace('₱','').replace(/,/g,'').trim();
                document.getElementById('mat_total').value = cells[6].textContent.replace('₱','').replace(/,/g,'').trim();
                document.getElementById('mat_received').valueAsDate = new Date(cells[7].textContent.trim());
                document.getElementById('mat_inspected').valueAsDate = new Date(cells[8].textContent.trim());
                document.getElementById('mat_status').value = cells[9].textContent.trim();
                document.getElementById('mat_location').value = cells[10].textContent.trim();
            } else {
                materialForm.reset();
                document.getElementById('mat_total').value = 0;
            }

            materialModal.classList.add('active');
        }

        function closeMaterialModal() {
            materialModal.classList.remove('active');
        }

        // Auto-calc total cost
        const qtyEl = document.getElementById('mat_qty');
        const priceEl = document.getElementById('mat_price');
        const totalEl = document.getElementById('mat_total');
        function recalc() {
            const q = parseFloat(qtyEl.value || '0');
            const p = parseFloat(priceEl.value || '0');
            totalEl.value = (q * p).toFixed(2);
        }
        qtyEl.addEventListener('input', recalc);
        priceEl.addEventListener('input', recalc);

        // Demo-only submit handler (no backend yet)
        materialForm.addEventListener('submit', function(e) {
            e.preventDefault();
            closeMaterialModal();
        });
    </script>
</body>

</html>


