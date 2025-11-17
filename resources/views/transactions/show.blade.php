<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - {{ $project->title }} - Transactions</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
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
            --red-600: #dc2626;
            --green-600: #059669;
            --black-1: #111827;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;
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
            font-family: "Inter", sans-serif;
            background-color: var(--main-bg);
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 769px) {
            .main-content { 
                margin-left: 280px; 
            }
            .main-content.sidebar-closed { 
                margin-left: 0; 
            }
        }

        @media (max-width: 768px) {
            .main-content { 
                margin-left: 0 !important; 
            }
        }

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

        .back-btn {
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .content-area {
            flex: 1;
            padding: 30px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .project-info-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: var(--shadow-md);
        }

        .project-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .project-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .project-details h2 {
            color: var(--black-1);
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .project-details p {
            color: var(--gray-600);
            font-size: 14px;
        }

        .project-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding-top: 16px;
            border-top: 1px solid #f3f4f6;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .meta-item i {
            color: var(--accent);
        }

        .meta-label {
            color: var(--gray-600);
        }

        .meta-value {
            color: var(--black-1);
            font-weight: 500;
        }

        .section-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: var(--shadow-md);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-title {
            color: var(--black-1);
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--red-600);
        }

        .action-btn {
            padding: 10px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: opacity 0.2s ease;
        }

        .action-btn:hover {
            opacity: 0.9;
        }

        .action-btn.primary {
            background: var(--blue-600);
            color: white;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .data-table thead {
            background: #f9fafb;
        }

        .data-table thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-700);
            text-transform: uppercase;
            border-bottom: 1px solid #e5e7eb;
        }

        .data-table tbody td {
            padding: 12px 16px;
            font-size: 14px;
            color: var(--black-1);
            border-bottom: 1px solid #f3f4f6;
        }

        .data-table tbody tr:hover {
            background: #f9fafb;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .empty-message {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray-500);
            font-size: 14px;
        }

        .empty-message i {
            font-size: 48px;
            color: var(--gray-300);
            margin-bottom: 12px;
            display: block;
        }

        .suppliers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
        }

        .supplier-card {
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .supplier-card:hover {
            border-color: var(--accent);
            background: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .supplier-card i {
            font-size: 32px;
            color: var(--accent);
            margin-bottom: 12px;
        }

        .supplier-card .supplier-name {
            font-size: 16px;
            font-weight: 600;
            color: var(--black-1);
            margin-bottom: 4px;
        }

        .supplier-card .supplier-info {
            font-size: 12px;
            color: var(--gray-600);
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--black-1);
        }

        .modal-close {
            background: #f3f4f6;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .modal-close:hover {
            background: #e5e7eb;
        }

        @media (max-width: 768px) {
            .content-area {
                padding: 20px;
            }

            .project-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .project-meta {
                flex-direction: column;
                gap: 12px;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .suppliers-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main class="main-content" id="mainContent">
            <header class="header">
                <a href="{{ route('transactions.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Projects
                </a>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <section class="content-area">
                <!-- Project Info -->
                <div class="project-info-card">
                    <div class="project-header">
                        <div class="project-icon" style="background-color: {{ $project->color ?? '#16a34a' }};">
                            <i class="fas fa-folder"></i>
                        </div>
                        <div class="project-details">
                            <h2>{{ $project->title }}</h2>
                            <p>{{ $project->client }}</p>
                        </div>
                    </div>
                    <div class="project-meta">
                        <div class="meta-item">
                            <i class="fas fa-user"></i>
                            <span class="meta-label">Inspector:</span>
                            <span class="meta-value">{{ $project->inspector }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span class="meta-label">Time:</span>
                            <span class="meta-value">{{ $project->time }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <span class="meta-label">Created:</span>
                            <span class="meta-value">{{ $project->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- To Be Returned Section -->
                <div class="section-card">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            To Be Returned
                        </h2>
                        <button class="action-btn primary" onclick="openSuppliersModal()">
                            <i class="fas fa-file-invoice"></i>
                            View Invoice
                        </button>
                    </div>

                    @if($project->materials->count() > 0)
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Material Name</th>
                                    <th>Batch/Serial No.</th>
                                    <th>Supplier</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Cost</th>
                                    <th>Date Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($project->materials as $material)
                                    <tr>
                                        <td>{{ $material->name }}</td>
                                        <td>{{ $material->batch ?? 'N/A' }}</td>
                                        <td>{{ $material->supplier ?? 'N/A' }}</td>
                                        <td>{{ $material->quantity }} {{ $material->unit }}</td>
                                        <td>₱{{ number_format($material->price, 2) }}</td>
                                        <td>₱{{ number_format($material->total, 2) }}</td>
                                        <td>{{ $material->date_received ? date('M d, Y', strtotime($material->date_received)) : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-message">
                            <i class="fas fa-check-circle"></i>
                            <p>No failed materials to be returned</p>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    <!-- Suppliers Modal -->
    <div class="modal-overlay" id="suppliersModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Select Supplier</h3>
                <button class="modal-close" onclick="closeSuppliersModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            @if($suppliers->count() > 0)
                <div class="suppliers-grid">
                    @foreach($suppliers as $supplier)
                        <a href="{{ route('transactions.invoice', ['projectId' => $project->id, 'supplier' => $supplier]) }}" style="text-decoration: none;">
                            <div class="supplier-card">
                                <i class="fas fa-truck"></i>
                                <div class="supplier-name">{{ $supplier }}</div>
                                <div class="supplier-info">View Invoice</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-message">
                    <i class="fas fa-truck"></i>
                    <p>No suppliers found for this project</p>
                </div>
            @endif
        </div>
    </div>

    @include('partials.sidebar-js')

    <script>
        function openSuppliersModal() {
            document.getElementById('suppliersModal').classList.add('active');
        }

        function closeSuppliersModal() {
            document.getElementById('suppliersModal').classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('suppliersModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSuppliersModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSuppliersModal();
            }
        });
    </script>
</body>
</html>
