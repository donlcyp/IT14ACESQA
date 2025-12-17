<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Dashboard</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --accent: #1e40af;
            --white: #ffffff;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;

            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-500: #667085;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --black-1: #111827;

            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: var(--accent);
            --green-600: #1e40af;

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
            font-family: 'Inter', sans-serif;
            background-color: var(--main-bg);
            color: var(--gray-700);
        }

        /* Sidebar has been moved to partials/sidebar.blade.php */

        /* Main Content Area */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease;
        }
        
        /* When sidebar is hidden on desktop */
        .main-content.sidebar-closed { 
            margin-left: 0; 
        }
        
        /* Desktop: Reserve space for sidebar */
        @media (min-width: 769px) {
            .main-content { 
                margin-left: 280px; 
            }
            .main-content.sidebar-closed { 
                margin-left: 0; 
            }
        }
        
        /* Mobile: Sidebar overlays, no margin */
        @media (max-width: 768px) {
            .main-content { 
                margin-left: 0 !important; 
            }
            .main-content.sidebar-closed { 
                margin-left: 0 !important; 
            }
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--header-bg), #1e40af);
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

        @media (max-width: 768px) {
            .header {
                padding: 16px 20px;
                gap: 16px;
            }
            
            .header-menu {
                display: block;
            }
        }

        .header-title {
            color: white;
            font-family: "Zen Dots", sans-serif;
            font-size: 24px;
            font-weight: 400;
            flex: 1;
        }
        
        @media (max-width: 768px) {
            .header-title {
                font-size: 18px;
            }
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 40px;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            max-width: 1800px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }
        
        @media (max-width: 1280px) {
            .content-area {
                max-width: 100%;
                padding: 32px;
            }
        }
        
        @media (max-width: 768px) {
            .content-area {
                padding: 20px;
            }
        }

        /* Summary Statistics Card */
        .summary-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border: 1px solid #e5e7eb;
            margin-bottom: 28px;
            display: flex;
            gap: 40px;
            align-items: center;
            transition: box-shadow 0.3s ease;
        }
        
        .summary-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .summary-item {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0 16px;
            position: relative;
            min-width: 160px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 8px;
            cursor: pointer;
        }

        .summary-item:hover {
            background-color: rgba(30, 64, 175, 0.05);
            padding-left: 20px;
        }

        .summary-item:active {
            padding-left: 16px;
        }

        .summary-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 50px;
            background-color: #e5e7eb;
        }
        
        @media (max-width: 1024px) {
            .summary-card {
                gap: 32px;
                flex-wrap: wrap;
            }
            
            .summary-item {
                flex: 0 1 calc(50% - 16px);
                padding: 0 16px;
            }
            
            .summary-item:not(:last-child)::after {
                height: 40px;
            }
        }
        
        @media (max-width: 640px) {
            .summary-card {
                gap: 16px;
                padding: 20px;
            }
            
            .summary-item {
                flex: 1;
                padding: 12px 0;
            }
            
            .summary-item:not(:last-child)::after {
                display: none;
            }
        }

        .summary-icon {
            width: 52px;
            height: 52px;
            background-color: var(--blue-600);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            flex-shrink: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.25);
        }

        .summary-item:hover .summary-icon {
            transform: scale(1.12);
            box-shadow: 0 6px 16px rgba(30, 64, 175, 0.35);
        }

        .summary-item:active .summary-icon {
            transform: scale(1.05);
        }

        .summary-content {
            display: flex;
            flex-direction: column;
            gap: 4px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .summary-item:hover .summary-content {
            gap: 6px;
        }

        .summary-label {
            color: var(--gray-600);
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
        }

        .summary-number {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 28px;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -0.5px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .summary-item:hover .summary-number {
            font-size: 30px;
            color: #1e40af;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
            margin-top: 8px;
        }

        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            color: var(--gray-700);
            display: flex;
            flex-direction: column;
            gap: 26px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dashboard-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9);
            border-color: #d1d5db;
        }

        .dashboard-card.full {
            grid-column: span 12;
        }

        .dashboard-card.half {
            grid-column: span 6;
        }

        .dashboard-card.third {
            grid-column: span 4;
        }
        
        @media (max-width: 1024px) {
            .dashboard-grid {
                gap: 20px;
            }
            
            .dashboard-card {
                padding: 24px;
                gap: 20px;
            }
            
            .dashboard-card.half {
                grid-column: span 12;
            }
            
            .dashboard-card.third {
                grid-column: span 6;
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-grid {
                gap: 16px;
            }
            
            .dashboard-card {
                padding: 20px;
                gap: 16px;
            }
            
            .dashboard-card.half,
            .dashboard-card.third {
                grid-column: span 12;
            }
        }

        .dashboard-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
        }

        .dashboard-card-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            letter-spacing: -0.5px;
        }

        .dashboard-card-subtitle {
            font-size: 13px;
            color: #6b7280;
            font-weight: 500;
            margin-top: 2px;
        }
        
        @media (max-width: 768px) {
            .dashboard-card-header {
                gap: 16px;
            }
            
            .dashboard-card-title {
                font-size: 18px;
            }
            
            .dashboard-card-subtitle {
                font-size: 12px;
            }
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
        }

        .dashboard-table tbody tr:not(:last-child) td {
            border-bottom: 1px solid #e5e7eb;
        }

        .dashboard-table td {
            padding: 14px 12px;
            font-size: 14px;
            color: var(--gray-700);
            vertical-align: middle;
        }

        .dashboard-table td:nth-child(3),
        .dashboard-table td:nth-child(5),
        .dashboard-table td:nth-child(6),
        .dashboard-table td:nth-child(7) {
            text-align: right;
        }

        .dashboard-table td:nth-child(5) {
            text-align: center;
        }

        .dashboard-table td:nth-child(7) {
            font-weight: 600;
            text-align: center;
        }

        .dashboard-table thead th {
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .dashboard-table thead th:nth-child(3),
        .dashboard-table thead th:nth-child(5),
        .dashboard-table thead th:nth-child(6),
        .dashboard-table thead th:nth-child(7) {
            text-align: right;
        }

        .dashboard-table thead th:nth-child(5) {
            text-align: center;
        }

        .dashboard-table thead th:nth-child(7) {
            text-align: center;
        }

        /* Center Status column in first dashboard card (Active Projects) */
        .dashboard-grid > .dashboard-card:nth-child(1) .dashboard-table td:nth-child(3),
        .dashboard-grid > .dashboard-card:nth-child(1) .dashboard-table thead th:nth-child(3) {
            text-align: center;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-badge.success {
            background-color: transparent;
            color: #047857;
        }

        .status-badge.warning {
            background-color: transparent;
            color: #a16207;
        }

        .status-badge.info {
            background-color: transparent;
            color: #1d4ed8;
        }


        .view-link {
            font-size: 14px;
            font-weight: 700;
            color: var(--blue-600);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 8px 12px;
            border-radius: 6px;
            position: relative;
        }

        .view-link:hover {
            color: #1e3a8a;
            background-color: rgba(30, 64, 175, 0.08);
            transform: translateX(2px);
        }

        .view-link:active {
            transform: translateX(0);
        }

        .view-link:focus {
            outline: 2px solid #1e40af;
            outline-offset: 2px;
        }

        .view-link i {
            font-size: 14px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .view-link:hover i {
            transform: translateX(3px);
        }

        /* KPI Cards Styles */
        .kpi-cards-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 32px;
            padding: 0;
            width: 100%;
        }
        
        /* Reorder: Total Projects (1), Ongoing Projects (2), Team Workers (4 -> 3) */
        .kpi-card:nth-child(4) {
            grid-column: 1 / span 1;
            grid-row: 2;
            order: 3;
        }

        .kpi-card:nth-child(5) {
            grid-column: 2 / span 1;
            grid-row: 2;
            order: 4;
        }

        .kpi-card:nth-child(3) {
            grid-column: 3 / span 1;
            grid-row: 1;
            order: 2;
        }

        @media (max-width: 1600px) {
            .kpi-cards-container {
                grid-template-columns: repeat(3, 1fr);
                gap: 18px;
                margin-bottom: 28px;
            }
            
            .kpi-card:nth-child(4) {
                grid-column: 1 / span 1;
                grid-row: 2;
            }

            .kpi-card:nth-child(5) {
                grid-column: 2 / span 1;
                grid-row: 2;
            }

            .kpi-card:nth-child(3) {
                grid-column: 3 / span 1;
                grid-row: 1;
            }
        }
        
        @media (max-width: 1200px) {
            .kpi-cards-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
                margin-bottom: 24px;
            }
            
            .kpi-card:nth-child(4) {
                grid-column: 1 / span 1;
                grid-row: 2;
            }

            .kpi-card:nth-child(5) {
                grid-column: 2 / span 1;
                grid-row: 2;
            }

            .kpi-card:nth-child(3) {
                grid-column: 1 / span 1;
                grid-row: 3;
            }
        }
        
        @media (max-width: 768px) {
            .kpi-cards-container {
                grid-template-columns: 1fr;
                gap: 14px;
                margin-bottom: 20px;
            }
            
            .kpi-card:nth-child(4) {
                grid-column: 1;
                grid-row: 3;
            }

            .kpi-card:nth-child(5) {
                grid-column: 1;
                grid-row: 5;
            }

            .kpi-card:nth-child(3) {
                grid-column: 1;
                grid-row: 4;
            }
        }

        .kpi-card {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(30, 64, 175, 0.06), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            border: 1px solid rgba(30, 64, 175, 0.15);
            display: flex;
            flex-direction: column;
            gap: 12px;
            position: relative;
            overflow: hidden;
            min-height: auto;
            justify-content: flex-start;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.15);
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
        }

        .kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.7);
            border-color: rgba(30, 64, 175, 0.3);
        }

        .kpi-card:hover::before {
            left: 100%;
        }

        .kpi-card:active {
            transform: translateY(-2px);
        }

        .kpi-card:focus {
            outline: 3px solid #1e40af;
            outline-offset: 2px;
        }
        
        @media (max-width: 768px) {
            .kpi-card {
                padding: 18px;
                min-height: auto;
                gap: 10px;
            }
        }

        .kpi-card.color-projects {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 1px solid rgba(30, 64, 175, 0.2);
        }

        .kpi-card.color-ongoing {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 1px solid rgba(30, 64, 175, 0.2);
        }

        .kpi-card.color-completed {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 1px solid rgba(30, 64, 175, 0.2);
        }

        .kpi-card.color-workers {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 1px solid rgba(30, 64, 175, 0.2);
        }

        .kpi-card.color-budget {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 1px solid rgba(30, 64, 175, 0.2);
        }

        .kpi-card.color-delayed {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 1px solid rgba(30, 64, 175, 0.2);
        }

        .kpi-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 6px rgba(30, 64, 175, 0.25);
        }

        .kpi-card:hover .kpi-icon {
            transform: scale(1.08);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.35);
        }

        .kpi-card:active .kpi-icon {
            transform: scale(0.98);
        }

        .kpi-card.color-projects .kpi-icon {
            background: #1e40af;
            color: white;
        }

        .kpi-card.color-ongoing .kpi-icon {
            background: #1e40af;
            color: white;
        }

        .kpi-card.color-completed .kpi-icon {
            background: #1e40af;
            color: white;
        }

        .kpi-card.color-workers .kpi-icon {
            background: #1e40af;
            color: white;
        }

        .kpi-card.color-budget .kpi-icon {
            background: #1e40af;
            color: white;
        }

        .kpi-card.color-delayed .kpi-icon {
            background: #1e40af;
            color: white;
        }

        .kpi-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            opacity: 0.75;
            margin-bottom: 1px;
            color: #1e3a8a;
        }

        .kpi-card.color-projects .kpi-label {
            color: #1e3a8a;
        }

        .kpi-card.color-ongoing .kpi-label {
            color: #1e3a8a;
        }

        .kpi-card.color-completed .kpi-label {
            color: #1e3a8a;
        }

        .kpi-card.color-workers .kpi-label {
            color: #1e3a8a;
        }

        .kpi-card.color-budget .kpi-label {
            color: #1e3a8a;
        }

        .kpi-card.color-delayed .kpi-label {
            color: #1e3a8a;
        }

        .kpi-value {
            font-size: 28px;
            font-weight: 800;
            line-height: 1;
            margin: 1px 0;
            letter-spacing: -0.7px;
            color: #1e3a8a;
        }

        .kpi-card.color-projects .kpi-value {
            color: #1e3a8a;
        }

        .kpi-card.color-ongoing .kpi-value {
            color: #1e3a8a;
        }

        .kpi-card.color-completed .kpi-value {
            color: #1e3a8a;
        }

        .kpi-card.color-workers .kpi-value {
            color: #1e3a8a;
        }

        .kpi-card.color-budget .kpi-value {
            color: #1e3a8a;
        }

        .kpi-card.color-delayed .kpi-value {
            color: #1e3a8a;
        }

        .kpi-subtitle {
            font-size: 11px;
            font-weight: 500;
            opacity: 0.7;
            margin-top: 1px;
            line-height: 1.3;
            color: #1e3a8a;
        }

        .kpi-card.color-projects .kpi-subtitle {
            color: #1e3a8a;
        }

        .kpi-card.color-ongoing .kpi-subtitle {
            color: #1e3a8a;
        }

        .kpi-card.color-completed .kpi-subtitle {
            color: #1e3a8a;
        }

        .kpi-card.color-workers .kpi-subtitle {
            color: #1e3a8a;
        }

        .kpi-card.color-budget .kpi-subtitle {
            color: #1e3a8a;
        }

        .kpi-card.color-delayed .kpi-subtitle {
            color: #1e3a8a;
        }

        /* Project Card Styles */
        .project-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 28px;
        }
        
        @media (min-width: 1400px) {
            .project-cards-container {
                grid-template-columns: repeat(auto-fill, minmax(420px, 1fr));
            }
        }
        
        @media (max-width: 1024px) {
            .project-cards-container {
                grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
                gap: 24px;
            }
        }
        
        @media (max-width: 768px) {
            .project-cards-container {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        .project-card {
            background: white;
            border-radius: 12px;
            padding: 26px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            position: relative;
            overflow: hidden;
        }

        .project-card::after {
            content: '';
            position: absolute;
            bottom: -100%;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, transparent, rgba(30, 64, 175, 0.05));
            transition: bottom 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
        }

        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(30, 64, 175, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.9);
            border-color: #dbeafe;
        }

        .project-card:hover::after {
            bottom: 0;
        }

        .project-card:active {
            transform: translateY(-2px);
        }

        .project-card:focus {
            outline: 3px solid #1e40af;
            outline-offset: 2px;
        }
        
        @media (max-width: 768px) {
            .project-card {
                padding: 20px;
                gap: 16px;
            }
        }

        .project-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            min-height: 48px;
        }

        .project-card-title {
            font-size: 17px;
            font-weight: 700;
            color: #1e3a8a;
            flex: 1;
            word-break: break-word;
            letter-spacing: -0.3px;
            line-height: 1.4;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover .project-card-title {
            color: #1e40af;
            font-size: 17.5px;
        }

        .project-card-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            flex-shrink: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .project-card:hover .project-card-status {
            transform: scale(1.05);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        .project-card-info {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            font-size: 13px;
            color: #6b7280;
            padding-top: 14px;
            border-top: 1px solid #f3f4f6;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover .project-card-info {
            border-top-color: #e5e7eb;
            color: #374151;
        }

        .project-card-info-item {
            flex: 1;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover .project-card-info-item {
            opacity: 0.95;
        }

        .project-card-info-label {
            font-size: 10px;
            font-weight: 700;
            color: #9ca3af;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
            transition: color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover .project-card-info-label {
            color: #6b7280;
        }

        .project-card-info-value {
            font-size: 14px;
            font-weight: 700;
            color: #1f2937;
            transition: color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover .project-card-info-value {
            color: #1e40af;
        }

        /* BOQ Item Card */
        .boq-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }
        
        @media (min-width: 1400px) {
            .boq-cards-container {
                grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .boq-cards-container {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        .boq-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 14px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            position: relative;
            overflow: hidden;
        }

        .boq-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #1e40af, #3b82f6);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .boq-card:hover::before {
            transform: scaleX(1);
        }

        .boq-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border-color: #dbeafe;
        }

        .boq-card:focus {
            outline: 3px solid #1e40af;
            outline-offset: 2px;
        }
        
        @media (max-width: 768px) {
            .boq-card {
                padding: 16px;
                gap: 10px;
            }
        }

        .boq-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .boq-card-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e3a8a;
            flex: 1;
            word-break: break-word;
        }

        .boq-card-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .boq-card-project {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }

        .boq-card-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            font-size: 13px;
            padding-top: 8px;
            border-top: 1px solid #f3f4f6;
        }

        .boq-detail-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .boq-detail-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .boq-detail-value {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        /* Finance Card */
        .finance-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }
        
        @media (min-width: 1400px) {
            .finance-cards-container {
                grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .finance-cards-container {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        .finance-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 14px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .finance-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(30, 64, 175, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border-color: #d1d5db;
        }

        .finance-card:focus {
            outline: 2px solid #1e40af;
            outline-offset: 2px;
        }
        
        @media (max-width: 768px) {
            .finance-card {
                padding: 16px;
                gap: 10px;
            }
        }

        .finance-card-title {
            font-size: 17px;
            font-weight: 700;
            color: #1e3a8a;
        }

        .finance-card-budget {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .finance-budget-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .finance-budget-amount {
            font-size: 16px;
            font-weight: 700;
            color: #1e3a8a;
        }

        .finance-progress {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 12px 0;
        }

        .finance-progress-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }

        .finance-progress-bar {
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }

        .finance-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #1e40af, #60a5fa);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .finance-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
        }

        .finance-status-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .finance-status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Attendance Card Styles */
        .attendance-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        @media (min-width: 1400px) {
            .attendance-cards-container {
                grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .attendance-cards-container {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        .attendance-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .attendance-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(30, 64, 175, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border-color: #d1d5db;
        }
        
        @media (max-width: 768px) {
            .attendance-card {
                padding: 16px;
            }
        }

        .attendance-card-date {
            font-size: 14px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .attendance-card-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .attendance-card-detail {
            font-size: 13px;
            color: #6b7280;
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
        }

        .attendance-card-detail-label {
            font-weight: 600;
        }

        .attendance-card-detail-value {
            color: #1f2937;
            font-weight: 600;
        }

        /* Empty State */
        .empty-state {
            padding: 40px 20px;
            text-align: center;
            color: #6b7280;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 12px;
            opacity: 0.3;
        }

        .empty-state-text {
            font-size: 16px;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .header-title {
                font-size: 20px;
            }

            .content-area {
                padding: 20px;
            }

            .summary-card {
                flex-direction: column;
                gap: 20px;
            }

            .summary-item {
                width: 100%;
                padding: 16px 0;
            }

            .summary-item:not(:last-child)::after {
                display: none;
            }

            .dashboard-grid {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }

            .dashboard-card,
            .dashboard-card.full,
            .dashboard-card.half,
            .dashboard-card.third {
                grid-column: span 1;
            }
        }

        @media (max-width: 480px) {
            .summary-card {
                padding: 16px;
            }

            .summary-item {
                flex-direction: column;
                text-align: center;
                gap: 12px;
            }

            .summary-number {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
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
                @if(isset($isQA) && $isQA)
                <!-- ========== QA DASHBOARD ========== -->
                <style>
                    .qa-kpi-card {
                        background: white;
                        border-radius: 12px;
                        padding: 20px;
                        border: 1px solid var(--gray-300);
                        transition: all 0.2s;
                        text-decoration: none;
                        display: block;
                    }
                    .qa-kpi-card:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
                        border-color: var(--accent);
                    }
                    .qa-kpi-card .kpi-icon {
                        width: 48px;
                        height: 48px;
                        border-radius: 10px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 20px;
                    }
                    .qa-kpi-card.pending .kpi-icon { background: #fef3c7; color: #92400e; }
                    .qa-kpi-card.approved .kpi-icon { background: #d1fae5; color: #065f46; }
                    .qa-kpi-card.failed .kpi-icon { background: #fee2e2; color: #991b1b; }
                    .qa-kpi-card.replacement .kpi-icon { background: #fce7f3; color: #9d174d; }
                    .qa-kpi-card.projects .kpi-icon { background: #dbeafe; color: #1e40af; }
                    .qa-kpi-card .kpi-value {
                        font-size: 32px;
                        font-weight: 700;
                        color: var(--black-1);
                        margin: 8px 0 4px 0;
                    }
                    .qa-kpi-card .kpi-label {
                        font-size: 13px;
                        font-weight: 600;
                        color: var(--gray-600);
                        text-transform: uppercase;
                        letter-spacing: 0.05em;
                    }
                    .qa-kpi-card .kpi-subtitle {
                        font-size: 12px;
                        color: var(--gray-500);
                    }
                    .qa-section-title {
                        font-size: 18px;
                        font-weight: 700;
                        color: var(--black-1);
                        margin-bottom: 16px;
                        display: flex;
                        align-items: center;
                        gap: 10px;
                    }
                    .qa-section-title i {
                        color: var(--accent);
                    }
                    .qa-recent-card {
                        background: white;
                        border-radius: 12px;
                        border: 1px solid var(--gray-300);
                        overflow: hidden;
                    }
                    .qa-recent-header {
                        padding: 16px 20px;
                        border-bottom: 1px solid var(--gray-300);
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    }
                    .qa-recent-title {
                        font-size: 16px;
                        font-weight: 600;
                        color: var(--black-1);
                    }
                    .qa-recent-list {
                        padding: 0;
                    }
                    .qa-recent-item {
                        padding: 14px 20px;
                        border-bottom: 1px solid var(--gray-300);
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    }
                    .qa-recent-item:last-child {
                        border-bottom: none;
                    }
                    .qa-recent-item:hover {
                        background: #fafafa;
                    }
                    .qa-item-name {
                        font-weight: 500;
                        color: var(--black-1);
                        margin-bottom: 4px;
                    }
                    .qa-item-project {
                        font-size: 12px;
                        color: var(--gray-600);
                    }
                    .qa-view-all {
                        font-size: 13px;
                        color: var(--accent);
                        text-decoration: none;
                        font-weight: 500;
                    }
                    .qa-view-all:hover {
                        text-decoration: underline;
                    }
                    .qa-status-badge {
                        padding: 4px 10px;
                        border-radius: 12px;
                        font-size: 11px;
                        font-weight: 600;
                    }
                    .qa-status-badge.pending { background: #fef3c7; color: #92400e; }
                    .qa-status-badge.failed { background: #fee2e2; color: #991b1b; }
                </style>

                <!-- QA Dashboard Header -->
                <div style="margin-bottom: 24px;">
                    <h2 style="font-size: 24px; font-weight: 700; color: var(--black-1); margin-bottom: 4px;">
                        <i class="fas fa-clipboard-check" style="color: var(--accent); margin-right: 8px;"></i>
                        Quality Assurance Dashboard
                    </h2>
                    <p style="color: var(--gray-600);">Monitor and inspect materials from your assigned projects</p>
                </div>

                <!-- QA KPI Cards -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 32px;">
                    <a href="{{ route('qa.materials') }}?status=pending" class="qa-kpi-card pending">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <div class="kpi-label">Pending Inspection</div>
                                <div class="kpi-value">{{ $qaSummary['pending_count'] ?? 0 }}</div>
                                <div class="kpi-subtitle">Awaiting QA review</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('qa.materials') }}?status=approved" class="qa-kpi-card approved">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <div class="kpi-label">Approved Materials</div>
                                <div class="kpi-value">{{ $qaSummary['approved_count'] ?? 0 }}</div>
                                <div class="kpi-subtitle">Passed inspection</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('qa.materials') }}?status=failed" class="qa-kpi-card failed">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <div class="kpi-label">Failed Materials</div>
                                <div class="kpi-value">{{ $qaSummary['failed_count'] ?? 0 }}</div>
                                <div class="kpi-subtitle">Did not pass QA</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('qa.materials') }}?status=replacement" class="qa-kpi-card replacement">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <div class="kpi-label">Needs Replacement</div>
                                <div class="kpi-value">{{ $qaSummary['replacement_count'] ?? 0 }}</div>
                                <div class="kpi-subtitle">Pending replacement</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('qa.materials') }}" class="qa-kpi-card projects">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <div class="kpi-label">Assigned Projects</div>
                                <div class="kpi-value">{{ $qaSummary['assigned_projects'] ?? 0 }}</div>
                                <div class="kpi-subtitle">Projects you monitor</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-folder-open"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Recent Items Grid -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 24px;">
                    <!-- Recent Pending Materials -->
                    <div class="qa-recent-card">
                        <div class="qa-recent-header">
                            <span class="qa-recent-title">
                                <i class="fas fa-clock" style="color: #f59e0b; margin-right: 8px;"></i>
                                Recent Pending Materials
                            </span>
                            <a href="{{ route('qa.materials') }}?status=pending" class="qa-view-all">View All →</a>
                        </div>
                        <div class="qa-recent-list">
                            @forelse($recentPending ?? collect() as $material)
                            <div class="qa-recent-item">
                                <div>
                                    <div class="qa-item-name">{{ Str::limit($material->item_description ?? $material->material_name ?? 'Unnamed', 40) }}</div>
                                    <div class="qa-item-project">{{ $material->project->project_name ?? 'Unknown Project' }}</div>
                                </div>
                                <span class="qa-status-badge pending">Pending</span>
                            </div>
                            @empty
                            <div style="padding: 30px; text-align: center; color: var(--gray-500);">
                                <i class="fas fa-check-circle" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                                No pending materials
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Recent Failed Materials -->
                    <div class="qa-recent-card">
                        <div class="qa-recent-header">
                            <span class="qa-recent-title">
                                <i class="fas fa-times-circle" style="color: #ef4444; margin-right: 8px;"></i>
                                Recent Failed Materials
                            </span>
                            <a href="{{ route('qa.materials') }}?status=failed" class="qa-view-all">View All →</a>
                        </div>
                        <div class="qa-recent-list">
                            @forelse($recentFailed ?? collect() as $material)
                            <div class="qa-recent-item">
                                <div>
                                    <div class="qa-item-name">{{ Str::limit($material->item_description ?? $material->material_name ?? 'Unnamed', 40) }}</div>
                                    <div class="qa-item-project">
                                        {{ $material->project->project_name ?? 'Unknown Project' }}
                                        @if($material->failure_reason)
                                        <span style="color: #991b1b;"> • {{ Str::limit($material->failure_reason, 25) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="qa-status-badge failed">Failed</span>
                            </div>
                            @empty
                            <div style="padding: 30px; text-align: center; color: var(--gray-500);">
                                <i class="fas fa-thumbs-up" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                                No failed materials
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Assigned Projects Section -->
                @if(isset($assignedProjects) && $assignedProjects->count() > 0)
                <div style="margin-top: 32px;">
                    <h3 class="qa-section-title">
                        <i class="fas fa-project-diagram"></i>
                        My Assigned Projects
                    </h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 16px;">
                        @foreach($assignedProjects as $project)
                        <a href="{{ route('projects.show', $project->id) }}" style="text-decoration: none;">
                            <div style="background: white; border: 1px solid var(--gray-300); border-radius: 12px; padding: 20px; transition: all 0.2s;">
                                <div style="font-weight: 600; color: var(--black-1); margin-bottom: 8px;">{{ $project->project_name ?? $project->project_code }}</div>
                                <div style="font-size: 13px; color: var(--gray-600); margin-bottom: 12px;">
                                    Client: {{ $project->client->company_name ?? 'N/A' }}
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; background: {{ $project->status === 'Completed' ? '#d1fae5' : '#dbeafe' }}; color: {{ $project->status === 'Completed' ? '#065f46' : '#1e40af' }};">
                                        {{ $project->status ?? 'Ongoing' }}
                                    </span>
                                    <span style="font-size: 12px; color: var(--gray-500);">
                                        {{ $project->materials->count() ?? 0 }} materials
                                    </span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                @else
                <!-- ========== REGULAR DASHBOARD (Non-QA Users) ========== -->
                <!-- KPI Summary Cards -->
                <div class="kpi-cards-container">
                    <!-- Total Projects Card -->
                    <a href="{{ route('projects') }}" class="kpi-card color-projects" title="View all projects">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Total Projects</div>
                                <div class="kpi-value">{{ number_format($summary['total_projects'] ?? 0) }}</div>
                                <div class="kpi-subtitle">All projects in system</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Ongoing Projects Card -->
                    <a href="{{ route('projects') }}?status=Ongoing" class="kpi-card color-ongoing" title="View ongoing projects">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Ongoing Projects</div>
                                <div class="kpi-value">{{ number_format($summary['ongoing_projects'] ?? 0) }}</div>
                                <div class="kpi-subtitle">Currently in progress</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-spinner"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Completed Projects Card -->
                    <a href="{{ route('projects') }}?status=Completed" class="kpi-card color-completed" title="View completed projects">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Completed Projects</div>
                                <div class="kpi-value">{{ number_format($summary['complete_projects'] ?? 0) }}</div>
                                <div class="kpi-subtitle">Successfully finished</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Total Team Workers Card -->
                    <a href="{{ route('employee') }}" class="kpi-card color-workers" title="View all employees">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Team Workers</div>
                                <div class="kpi-value">{{ number_format($summary['total_workers'] ?? 0) }}</div>
                                <div class="kpi-subtitle">Active employees</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Delayed Projects Card -->
                    <a href="{{ route('projects') }}" class="kpi-card color-delayed" title="View delayed projects">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Delayed Projects</div>
                                <div class="kpi-value">{{ number_format($summary['delayed_projects'] ?? 0) }}</div>
                                <div class="kpi-subtitle">Behind schedule</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Date Filter Section -->
                @if(!isset($isEmployee) || !$isEmployee)
                <div class="dashboard-card full" style="margin-bottom: 24px; padding: 20px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-filter" style="color: var(--accent); font-size: 18px;"></i>
                            <span style="font-weight: 600; color: var(--black-1);">Filter Dashboard Data</span>
                        </div>
                        <form method="GET" action="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                            <select name="filter_type" id="filterType" onchange="toggleCustomDates()" style="padding: 10px 14px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; color: var(--gray-700); min-width: 150px;">
                                <option value="all" {{ ($filterType ?? 'all') === 'all' ? 'selected' : '' }}>All Time</option>
                                <option value="this_month" {{ ($filterType ?? '') === 'this_month' ? 'selected' : '' }}>This Month</option>
                                <option value="last_month" {{ ($filterType ?? '') === 'last_month' ? 'selected' : '' }}>Last Month</option>
                                <option value="this_year" {{ ($filterType ?? '') === 'this_year' ? 'selected' : '' }}>This Year</option>
                                <option value="last_year" {{ ($filterType ?? '') === 'last_year' ? 'selected' : '' }}>Last Year</option>
                                <option value="custom" {{ ($filterType ?? '') === 'custom' ? 'selected' : '' }}>Custom Range</option>
                            </select>
                            <div id="customDateInputs" style="display: {{ ($filterType ?? '') === 'custom' ? 'flex' : 'none' }}; align-items: center; gap: 8px;">
                                <input type="date" name="date_from" value="{{ $dateFrom ?? '' }}" placeholder="From" style="padding: 10px 14px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;">
                                <span style="color: var(--gray-500);">to</span>
                                <input type="date" name="date_to" value="{{ $dateTo ?? '' }}" placeholder="To" style="padding: 10px 14px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;">
                            </div>
                            <button type="submit" style="padding: 10px 20px; background: var(--accent); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: all 0.2s;">
                                <i class="fas fa-search"></i> Apply Filter
                            </button>
                            @if(($filterType ?? 'all') !== 'all')
                            <a href="{{ route('dashboard') }}" style="padding: 10px 16px; background: #f3f4f6; color: var(--gray-700); border-radius: 8px; font-weight: 500; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-times"></i> Clear
                            </a>
                            @endif
                        </form>
                    </div>
                    @if(($filterType ?? 'all') !== 'all')
                    <div style="margin-top: 12px; padding: 10px 14px; background: #dbeafe; border-radius: 6px; font-size: 13px; color: #1e40af;">
                        <i class="fas fa-info-circle"></i> 
                        Showing data for: 
                        @if(($filterType ?? '') === 'this_month')
                            <strong>{{ \Carbon\Carbon::now()->format('F Y') }}</strong>
                        @elseif(($filterType ?? '') === 'last_month')
                            <strong>{{ \Carbon\Carbon::now()->subMonth()->format('F Y') }}</strong>
                        @elseif(($filterType ?? '') === 'this_year')
                            <strong>{{ \Carbon\Carbon::now()->format('Y') }}</strong>
                        @elseif(($filterType ?? '') === 'last_year')
                            <strong>{{ \Carbon\Carbon::now()->subYear()->format('Y') }}</strong>
                        @elseif($dateFrom && $dateTo)
                            <strong>{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</strong>
                        @endif
                    </div>
                    @endif
                </div>
                @endif

                <!-- Detailed Insights -->
                <div class="dashboard-grid">
                    @if (isset($isEmployee) && $isEmployee)
                        <!-- EMPLOYEE VIEW -->
                        <div class="dashboard-card full">
                            <div class="dashboard-card-header">
                                <div>
                                    <div class="dashboard-card-title">My Assigned Project</div>
                                    <div class="dashboard-card-subtitle">Project you are currently working on</div>
                                </div>
                            </div>

                            <div class="project-cards-container">
                                @forelse ($assignedProjects ?? collect() as $project)
                                    @php
                                        $projectDisplayStatus = $project->status === 'On Track' ? 'Ongoing' : $project->status;
                                        $statusMap = [
                                            'Ongoing'    => ['class' => 'success', 'icon' => 'fas fa-check'],
                                            'Under Review' => ['class' => 'warning', 'icon' => 'fas fa-hourglass-half'],
                                            'In Review'  => ['class' => 'warning', 'icon' => 'fas fa-hourglass-half'],
                                            'Mobilizing' => ['class' => 'info', 'icon' => 'fas fa-bolt'],
                                            'On Hold'    => ['class' => 'warning', 'icon' => 'fas fa-pause'],
                                            'Completed'  => ['class' => 'success', 'icon' => 'fas fa-check-circle'],
                                        ];
                                        $badge = $statusMap[$projectDisplayStatus] ?? ['class' => 'info', 'icon' => 'fas fa-bolt'];
                                        
                                        // Get client name from relationship or fallback to project fields
                                        if ($project->client) {
                                            $clientName = $project->client->company_name ?? $project->client->name ?? 'N/A';
                                        } else {
                                            $clientName = trim(($project->client_first_name ?? '') . ' ' . ($project->client_last_name ?? '')) ?: 'N/A';
                                        }
                                        
                                        // Get lead name from PM relationship or fallback to lead field
                                        $leadName = $project->assignedPM?->name ?? $project->lead ?? 'N/A';
                                    @endphp
                                    <a href="{{ route('projects.show', $project->id) }}" class="project-card">
                                        <div class="project-card-header">
                                            <div class="project-card-title">{{ $project->project_name ?? $project->project_code }}</div>
                                            <span class="project-card-status status-badge {{ $badge['class'] }}">
                                                <i class="{{ $badge['icon'] }}"></i>
                                                {{ $projectDisplayStatus ?? '—' }}
                                            </span>
                                        </div>
                                        <div class="project-card-info">
                                            <div class="project-card-info-item">
                                                <div class="project-card-info-label">Client</div>
                                                <div class="project-card-info-value">{{ $clientName }}</div>
                                            </div>
                                            <div class="project-card-info-item">
                                                <div class="project-card-info-label">Lead</div>
                                                <div class="project-card-info-value">{{ $leadName }}</div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <div class="empty-state-text">You are not assigned to any project</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Today's Attendance -->
                        <div class="dashboard-card half">
                            <div class="dashboard-card-header">
                                <div>
                                    <div class="dashboard-card-title">Today's Attendance</div>
                                    <div class="dashboard-card-subtitle">Your current attendance status</div>
                                </div>
                            </div>

                            @if ($todayAttendance)
                                <div class="attendance-cards-container" style="grid-template-columns: 1fr;">
                                    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px;">
                                        <div class="attendance-card-status" style="background: #dbeafe; color: #1e3a8a;">
                                            {{ $todayAttendance->attendance_status }}
                                        </div>
                                        <div class="attendance-card-detail">
                                            <span class="attendance-card-detail-label">Status:</span>
                                            <span class="attendance-card-detail-value">{{ $todayAttendance->attendance_status }}</span>
                                        </div>
                                        <div class="attendance-card-detail">
                                            <span class="attendance-card-detail-label">Punch In:</span>
                                            <span class="attendance-card-detail-value">{{ $todayAttendance->punch_in_time ? $todayAttendance->punch_in_time->format('H:i:s') : 'Not yet' }}</span>
                                        </div>
                                        <div class="attendance-card-detail">
                                            <span class="attendance-card-detail-label">Punch Out:</span>
                                            <span class="attendance-card-detail-value">{{ $todayAttendance->punch_out_time ? $todayAttendance->punch_out_time->format('H:i:s') : '—' }}</span>
                                        </div>
                                        @if ($todayAttendance->is_late)
                                            <div class="attendance-card-detail" style="color: #dc2626;">
                                                <span class="attendance-card-detail-label">Late Arrival:</span>
                                                <span class="attendance-card-detail-value">{{ $todayAttendance->late_minutes }} min</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="empty-state-text">No attendance record for today yet</div>
                                    <a href="{{ $isEmployee ? route('my-attendance') : route('employee-attendance') }}" style="display: inline-block; margin-top: 12px; color: #1e40af; text-decoration: none; font-weight: 600;">Punch in now</a>
                                </div>
                            @endif
                        </div>

                        <!-- Recent Attendance History -->
                        <div class="dashboard-card half">
                            <div class="dashboard-card-header">
                                <div>
                                    <div class="dashboard-card-title">Recent Attendance</div>
                                    <div class="dashboard-card-subtitle">Last 5 attendance records</div>
                                </div>
                                <a class="view-link" href="{{ $isEmployee ? route('my-attendance') : route('employee-attendance') }}">
                                    View all
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>

                            <div class="attendance-cards-container">
                                @forelse ($recentAttendance as $record)
                                    <div class="attendance-card">
                                        <div class="attendance-card-date">{{ $record->date->format('M d, Y') }}</div>
                                        <span class="attendance-card-status status-badge {{ strtolower(str_replace(' ', '-', $record->attendance_status)) }}">
                                            {{ $record->attendance_status }}
                                        </span>
                                        <div class="attendance-card-detail">
                                            <span class="attendance-card-detail-label">Punch In:</span>
                                            <span class="attendance-card-detail-value">{{ $record->punch_in_time ? $record->punch_in_time->format('H:i') : '—' }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-history"></i>
                                        </div>
                                        <div class="empty-state-text">No attendance records yet</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <!-- ADMIN/PM VIEW -->
                        <div class="dashboard-card full">
                            <div class="dashboard-card-header">
                                <div>
                                    <div class="dashboard-card-title">Active Projects</div>
                                    <div class="dashboard-card-subtitle">Projects currently in execution with status</div>
                                </div>
                                <a class="view-link" href="{{ route('projects') }}">
                                    View all
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>

                            <div class="project-cards-container">
                                @php
                                    $statusMap = [
                                        'Ongoing'    => ['class' => 'success', 'icon' => 'fas fa-check'],
                                        'Under Review' => ['class' => 'warning', 'icon' => 'fas fa-hourglass-half'],
                                        'In Review'  => ['class' => 'warning', 'icon' => 'fas fa-hourglass-half'],
                                        'Mobilizing' => ['class' => 'info', 'icon' => 'fas fa-bolt'],
                                        'On Hold'    => ['class' => 'warning', 'icon' => 'fas fa-pause'],
                                        'Completed'  => ['class' => 'success', 'icon' => 'fas fa-check-circle'],
                                    ];
                                @endphp

                                @forelse ($activeProjects as $project)
                                    @php
                                        $projectDisplayStatus = $project->status === 'On Track' ? 'Ongoing' : $project->status;
                                        $badge = $statusMap[$projectDisplayStatus] ?? ['class' => 'info', 'icon' => 'fas fa-bolt'];
                                        
                                        // Get client name from relationship or fallback to project fields
                                        if ($project->client) {
                                            $clientName = $project->client->company_name ?? $project->client->name ?? 'N/A';
                                        } else {
                                            $clientName = trim(($project->client_first_name ?? '') . ' ' . ($project->client_last_name ?? '')) ?: 'N/A';
                                        }
                                        
                                        // Get lead name from PM relationship or fallback to lead field
                                        $leadName = $project->assignedPM?->name ?? $project->lead ?? 'N/A';
                                    @endphp
                                    <a href="{{ route('projects.show', $project->id) }}" class="project-card">
                                        <div class="project-card-header">
                                            <div class="project-card-title">{{ $project->project_name ?? $project->project_code }}</div>
                                            <span class="project-card-status status-badge {{ $badge['class'] }}">
                                                <i class="{{ $badge['icon'] }}"></i>
                                                {{ $projectDisplayStatus ?? '—' }}
                                            </span>
                                        </div>
                                        <div class="project-card-info">
                                            <div class="project-card-info-item">
                                                <div class="project-card-info-label">Client</div>
                                                <div class="project-card-info-value">{{ $clientName }}</div>
                                            </div>
                                            <div class="project-card-info-item">
                                                <div class="project-card-info-label">Lead</div>
                                                <div class="project-card-info-value">{{ $leadName }}</div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <div class="empty-state-text">No active projects yet</div>
                                    </div>
                                @endforelse
                            </div>
                    </div>

                    <!-- Project Statistics Chart -->
                    <div class="dashboard-card full">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Project Statistics</div>
                                <div class="dashboard-card-subtitle">Monthly project creation and completion trends</div>
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 24px;">
                            <!-- Projects Created vs Completed Chart -->
                            <div style="background: #f9fafb; border-radius: 12px; padding: 20px;">
                                <h4 style="font-size: 14px; font-weight: 600; color: var(--gray-700); margin-bottom: 16px;">
                                    <i class="fas fa-chart-line" style="color: var(--accent); margin-right: 8px;"></i>
                                    Projects Created vs Completed (Last 6 Months)
                                </h4>
                                <div style="height: 250px;">
                                    <canvas id="projectTrendChart"></canvas>
                                </div>
                            </div>
                            <!-- Project Status Distribution -->
                            <div style="background: #f9fafb; border-radius: 12px; padding: 20px;">
                                <h4 style="font-size: 14px; font-weight: 600; color: var(--gray-700); margin-bottom: 16px;">
                                    <i class="fas fa-chart-pie" style="color: var(--accent); margin-right: 8px;"></i>
                                    Current Project Status Distribution
                                </h4>
                                <div style="height: 250px;">
                                    <canvas id="projectStatusChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Historical / Completed Projects Section -->
                    @if(isset($historicalProjects) && $historicalProjects->count() > 0)
                    <div class="dashboard-card full" style="background: white; border: 1px solid #e5e7eb;">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title" style="color: #1e3a8a;">
                                    <i class="fas fa-history" style="margin-right: 8px;"></i>
                                    Historical Data - Completed Projects
                                </div>
                                <div class="dashboard-card-subtitle">Projects that have been successfully completed</div>
                            </div>
                            <a class="view-link" href="{{ route('projects') }}?status=Completed">
                                View all completed
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="project-cards-container">
                            @foreach ($historicalProjects as $project)
                                @php
                                    // Get client name
                                    if ($project->client) {
                                        $clientName = $project->client->company_name ?? $project->client->name ?? 'N/A';
                                    } else {
                                        $clientName = trim(($project->client_first_name ?? '') . ' ' . ($project->client_last_name ?? '')) ?: 'N/A';
                                    }
                                    
                                    // Calculate project duration
                                    $duration = 'N/A';
                                    if ($project->date_started && $project->date_ended) {
                                        $days = \Carbon\Carbon::parse($project->date_started)->diffInDays(\Carbon\Carbon::parse($project->date_ended));
                                        $duration = $days . ' days';
                                    }
                                    
                                    // Calculate total spent
                                    $totalSpent = 0;
                                    if ($project->materials && $project->materials->count() > 0) {
                                        foreach ($project->materials as $material) {
                                            $totalSpent += (($material->material_cost ?? 0) + ($material->labor_cost ?? 0)) * ($material->quantity ?? 0);
                                        }
                                    }
                                @endphp
                                <a href="{{ route('projects.show', $project->id) }}" class="project-card" style="border-color: #93c5fd;">
                                    <div class="project-card-header">
                                        <div class="project-card-title" style="color: #1e3a8a;">{{ $project->project_name ?? $project->project_code }}</div>
                                        <span class="project-card-status" style="background: #1e40af; color: white;">
                                            <i class="fas fa-check-circle"></i> Completed
                                        </span>
                                    </div>
                                    <div class="project-card-info" style="border-top-color: #bfdbfe;">
                                        <div class="project-card-info-item">
                                            <div class="project-card-info-label">Completed</div>
                                            <div class="project-card-info-value">{{ $project->date_ended ? \Carbon\Carbon::parse($project->date_ended)->format('M d, Y') : 'N/A' }}</div>
                                        </div>
                                        <div class="project-card-info-item">
                                            <div class="project-card-info-label">Duration</div>
                                            <div class="project-card-info-value">{{ $duration }}</div>
                                        </div>
                                        <div class="project-card-info-item">
                                            <div class="project-card-info-label">Total Spent</div>
                                            <div class="project-card-info-value">₱{{ number_format($totalSpent, 0) }}</div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="dashboard-card full">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Financial Overview</div>
                                <div class="dashboard-card-subtitle">Budget and spending analysis</div>
                            </div>
                            <a class="view-link" href="{{ route('finance-graphs') }}" title="View detailed graphs">
                                <i class="fas fa-chart-bar"></i> Detailed View
                            </a>
                        </div>

                        <!-- Finance Summary Stats -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-bottom: 30px;">
                            <div style="background: transparent; padding: 15px; border-radius: 8px; text-align: center;">
                                <div style="font-size: 12px; color: #1e3a8a; font-weight: 600; margin-bottom: 8px;">Total Budget</div>
                                <div style="font-size: 20px; font-weight: 700; color: #1e3a8a;">₱{{ number_format($summary['total_budget'] ?? 0, 0) }}</div>
                            </div>
                            <div style="background: transparent; padding: 15px; border-radius: 8px; text-align: center;">
                                <div style="font-size: 12px; color: #1e3a8a; font-weight: 600; margin-bottom: 8px;">Total Spent</div>
                                @php
                                    $totalSpent = 0;
                                    foreach($activeProjects as $project) {
                                        if ($project->materials && $project->materials->count() > 0) {
                                            foreach ($project->materials as $material) {
                                                $materialCost = $material->material_cost ?? 0;
                                                $laborCost = $material->labor_cost ?? 0;
                                                $quantity = $material->quantity ?? 0;
                                                $totalSpent += ($materialCost + $laborCost) * $quantity;
                                            }
                                        }
                                    }
                                @endphp
                                <div style="font-size: 20px; font-weight: 700; color: #1e3a8a;">₱{{ number_format($totalSpent, 0) }}</div>
                            </div>
                            <div style="background: transparent; padding: 15px; border-radius: 8px; text-align: center;">
                                <div style="font-size: 12px; color: #1e3a8a; font-weight: 600; margin-bottom: 8px;">Remaining</div>
                                <div style="font-size: 20px; font-weight: 700; color: #1e3a8a;">₱{{ number_format(($summary['total_budget'] ?? 0) - $totalSpent, 0) }}</div>
                            </div>
                            <div style="background: transparent; padding: 15px; border-radius: 8px; text-align: center;">
                                <div style="font-size: 12px; color: #1e3a8a; font-weight: 600; margin-bottom: 8px;">Usage</div>
                                <div style="font-size: 20px; font-weight: 700; color: #1e3a8a;">{{ ($summary['total_budget'] ?? 0) > 0 ? round(($totalSpent / ($summary['total_budget'] ?? 1)) * 100, 1) : 0 }}%</div>
                            </div>
                        </div>

                        <!-- Charts Grid -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                            <!-- Budget vs Spent Chart -->
                            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px;">
                                <div style="font-size: 14px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">Budget vs Spent</div>
                                <div style="height: 200px;">
                                    <canvas id="dashboardBudgetChart"></canvas>
                                </div>
                            </div>

                            <!-- Project Distribution Chart -->
                            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px;">
                                <div style="font-size: 14px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">Budget Distribution</div>
                                <div style="height: 200px;">
                                    <canvas id="dashboardDistributionChart"></canvas>
                                </div>
                            </div>

                            <!-- Project Spending Chart -->
                            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px;">
                                <div style="font-size: 14px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">Spending by Project</div>
                                <div style="height: 200px;">
                                    <canvas id="dashboardProjectChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-card full">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Finance & Transactions Summary</div>
                                <div class="dashboard-card-subtitle">Project budgets and financial overview</div>
                            </div>
                            <a class="view-link" href="{{ route('finance-graphs') }}" title="View financial graphs">
                                <i class="fas fa-chart-bar"></i>
                            </a>
                        </div>

                        <div class="finance-cards-container">
                            @forelse ($activeProjects as $project)
                                @php
                                    $projectBudget = $project->allocated_amount ?? 0;
                                    // Calculate total spent from all materials in this project
                                    $totalSpent = 0;
                                    if ($project->materials && $project->materials->count() > 0) {
                                        foreach ($project->materials as $material) {
                                            $materialCost = $material->material_cost ?? 0;
                                            $laborCost = $material->labor_cost ?? 0;
                                            $quantity = $material->quantity ?? 0;
                                            $totalSpent += ($materialCost + $laborCost) * $quantity;
                                        }
                                    }
                                    $remainingBudget = $projectBudget - $totalSpent;
                                    $percentageUsed = $projectBudget > 0 ? round(($totalSpent / $projectBudget) * 100, 1) : 0;
                                    
                                    // Determine status based on remaining budget
                                    if ($projectBudget == 0) {
                                        $budgetStatus = 'info';
                                        $statusText = 'No Budget';
                                        $statusColor = '#d1d5db';
                                    } elseif ($remainingBudget < 0) {
                                        $budgetStatus = 'fail';
                                        $statusText = 'Over Budget';
                                        $statusColor = '#dc2626';
                                    } elseif ($remainingBudget < ($projectBudget * 0.2)) {
                                        $budgetStatus = 'warning';
                                        $statusText = 'Critical';
                                        $statusColor = '#f59e0b';
                                    } else {
                                        $budgetStatus = 'success';
                                        $statusText = 'Healthy';
                                        $statusColor = '#1e40af';
                                    }
                                @endphp
                                <a href="{{ route('projects.show', $project->id) }}" class="finance-card">
                                    <div class="finance-card-title">
                                        {{ $project->project_name ?? $project->project_code }}
                                    </div>
                                    <div class="finance-card-budget">
                                        <span class="finance-budget-label">Budget</span>
                                        <span class="finance-budget-amount">₱{{ number_format($projectBudget, 0) }}</span>
                                    </div>
                                    <div class="finance-progress">
                                        <div class="finance-progress-label">
                                            Spent: <strong>₱{{ number_format($totalSpent, 0) }}</strong> ({{ $percentageUsed }}%)
                                        </div>
                                        <div class="finance-progress-bar">
                                            <div class="finance-progress-fill" style="width: {{ min($percentageUsed, 100) }}%; background: {{ $statusColor }};"></div>
                                        </div>
                                    </div>
                                    <div class="finance-status">
                                        <span class="finance-status-label">Remaining</span>
                                        <span class="finance-status-badge" style="background: {{ $statusColor }}20; color: {{ $statusColor }};">
                                            {{ $statusText }}
                                        </span>
                                    </div>
                                    <div style="padding-top: 8px; border-top: 1px solid #f3f4f6; font-size: 13px; display: flex; justify-content: space-between;">
                                        <span style="color: #6b7280;">Remaining Budget:</span>
                                        <strong style="color: {{ $remainingBudget < 0 ? '#dc2626' : '#1e3a8a' }};">₱{{ number_format($remainingBudget, 0) }}</strong>
                                    </div>
                                </a>
                            @empty
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    <div class="empty-state-text">No active projects available</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')

    <script>
        // Chart Colors
        const chartColors = {
            primary: '#1e40af',
            success: '#0369a1',
            warning: '#f59e0b',
            danger: '#ef4444',
            info: '#3b82f6',
            light: '#f3f4f6'
        };

        // Get data from page
        const projectsData = @json($activeProjects->map(function($p) {
            $totalSpent = 0;
            if ($p->materials && $p->materials->count() > 0) {
                foreach ($p->materials as $material) {
                    $materialCost = $material->material_cost ?? 0;
                    $laborCost = $material->labor_cost ?? 0;
                    $quantity = $material->quantity ?? 0;
                    $totalSpent += ($materialCost + $laborCost) * $quantity;
                }
            }
            return [
                'name' => $p->project_name ?? $p->project_code,
                'budget' => $p->allocated_amount ?? 0,
                'spent' => $totalSpent
            ];
        })->toArray() ?? []);

        const totalBudget = @json($summary['total_budget'] ?? 0);
        const totalSpent = (() => {
            let sum = 0;
            projectsData.forEach(p => sum += p.spent);
            return sum;
        })();

        // Chart 1: Budget vs Spent
        if (document.getElementById('dashboardBudgetChart')) {
            const budgetCtx = document.getElementById('dashboardBudgetChart').getContext('2d');
            new Chart(budgetCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Spent', 'Remaining'],
                    datasets: [{
                        data: [totalSpent, totalBudget - totalSpent],
                        backgroundColor: ['#1e40af', '#e5e7eb'],
                        borderColor: ['#fff', '#fff'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Chart 2: Project Distribution
        if (document.getElementById('dashboardDistributionChart')) {
            const distributionCtx = document.getElementById('dashboardDistributionChart').getContext('2d');
            new Chart(distributionCtx, {
                type: 'pie',
                data: {
                    labels: projectsData.map(p => p.name),
                    datasets: [{
                        data: projectsData.map(p => p.budget),
                        backgroundColor: [
                            '#1e40af',
                            '#0369a1',
                            '#3b82f6',
                            '#f59e0b',
                            '#ef4444'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Chart 3: Project Spending
        if (document.getElementById('dashboardProjectChart')) {
            const projectCtx = document.getElementById('dashboardProjectChart').getContext('2d');
            new Chart(projectCtx, {
                type: 'bar',
                data: {
                    labels: projectsData.map(p => p.name),
                    datasets: [
                        {
                            label: 'Budget',
                            data: projectsData.map(p => p.budget),
                            backgroundColor: '#1e40af'
                        },
                        {
                            label: 'Spent',
                            data: projectsData.map(p => p.spent),
                            backgroundColor: '#f59e0b'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Toggle Custom Date Inputs
        function toggleCustomDates() {
            const filterType = document.getElementById('filter_type');
            const customDates = document.getElementById('customDateInputs');
            if (filterType && customDates) {
                if (filterType.value === 'custom') {
                    customDates.style.display = 'flex';
                } else {
                    customDates.style.display = 'none';
                }
            }
        }

        // Chart 4: Project Trend (Line Chart - Created vs Completed over 6 months)
        @if(isset($monthlyStats) && count($monthlyStats) > 0)
        if (document.getElementById('projectTrendChart')) {
            const trendCtx = document.getElementById('projectTrendChart').getContext('2d');
            const monthlyStats = @json($monthlyStats);
            
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: monthlyStats.map(s => s.month_short),
                    datasets: [
                        {
                            label: 'Projects Created',
                            data: monthlyStats.map(s => s.created),
                            borderColor: '#1e40af',
                            backgroundColor: 'rgba(30, 64, 175, 0.1)',
                            fill: true,
                            tension: 0.3,
                            pointBackgroundColor: '#1e40af',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5
                        },
                        {
                            label: 'Projects Completed',
                            data: monthlyStats.map(s => s.completed),
                            borderColor: '#059669',
                            backgroundColor: 'rgba(5, 150, 105, 0.1)',
                            fill: true,
                            tension: 0.3,
                            pointBackgroundColor: '#059669',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        }
        @endif

        // Chart 5: Project Status Distribution (Pie Chart)
        if (document.getElementById('projectStatusChart')) {
            const statusCtx = document.getElementById('projectStatusChart').getContext('2d');
            const statusData = {
                ongoing: {{ $summary['ongoing_projects'] ?? 0 }},
                completed: {{ $summary['complete_projects'] ?? 0 }},
                delayed: {{ $summary['delayed_projects'] ?? 0 }}
            };
            
            // Only show statuses that have values > 0
            const labels = [];
            const data = [];
            const colors = [];
            
            if (statusData.ongoing > 0) {
                labels.push('Ongoing');
                data.push(statusData.ongoing);
                colors.push('#3b82f6'); // Blue
            }
            if (statusData.completed > 0) {
                labels.push('Completed');
                data.push(statusData.completed);
                colors.push('#10b981'); // Green
            }
            if (statusData.delayed > 0) {
                labels.push('Delayed');
                data.push(statusData.delayed);
                colors.push('#ef4444'); // Red
            }
            
            // Only render if we have data
            if (data.length > 0) {
                new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: colors,
                            borderColor: '#fff',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    usePointStyle: true
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = total > 0 ? Math.round((context.raw / total) * 100) : 0;
                                        return context.label + ': ' + context.raw + ' (' + percentage + '%)';
                                    }
                                }
                            }
                        }
                    }
                });
            }
        }
    </script>
</body>

</html>