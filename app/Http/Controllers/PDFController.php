<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use TCPDF;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    /**
     * Generate and download project report PDF using TCPDF (no GD required)
     */
    public function downloadProjectReport($projectId)
    {
        $project = Project::with([
            'employees.user', 
            'documents', 
            'updates', 
            'client', 
            'materials', 
            'purchaseOrders',
            'assignedPM'
        ])->findOrFail($projectId);

        try {
            $pdf = new TCPDF();
            $pdf->AddPage();
            $pdf->SetFont('helvetica', 'B', 16);
            
            // Header
            $pdf->SetTextColor(5, 150, 105); // Green
            $pdf->Cell(0, 10, $project->project_name, 0, 1, 'C');
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->Cell(0, 5, 'Report Generated: ' . now()->format('M d, Y H:i A'), 0, 1, 'C');
            $pdf->Ln(5);
            
            // PROJECT DETAILS SECTION
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetTextColor(5, 150, 105);
            $pdf->Cell(0, 8, 'Project Details', 0, 1, 'L');
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetTextColor(0, 0, 0);
            
            // Get client name from multiple sources
            $clientName = 'N/A';
            if ($project->client && $project->client->company_name) {
                $clientName = $project->client->company_name;
            } elseif ($project->client_first_name || $project->client_last_name) {
                $clientName = trim(($project->client_first_name ?? '') . ' ' . ($project->client_last_name ?? ''));
            }
            
            $summaryData = [
                ['Project Name', $project->project_name],
                ['Client', $clientName],
                ['Status', $project->pm_status ?? $project->status ?? 'N/A'],
                ['Start Date', $project->date_started ? $project->date_started->format('M d, Y') : 'N/A'],
                ['End Date', $project->date_ended ? $project->date_ended->format('M d, Y') : 'N/A'],
                ['Target Date', $project->target_timeline ? $project->target_timeline->format('M d, Y') : 'N/A'],
                ['Project Manager', $project->assignedPM?->name ?? 'N/A'],
                ['Location', $project->location ?? 'N/A'],
            ];
            
            $pdf->SetFillColor(240, 240, 240);
            $fill = true;
            foreach ($summaryData as $row) {
                $pdf->Cell(80, 7, $row[0], 1, 0, 'L', $fill);
                $pdf->Cell(0, 7, $row[1], 1, 1, 'L', $fill);
                $fill = !$fill;
            }
            $pdf->Ln(5);
            
            // BUDGET SECTION
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetTextColor(5, 150, 105);
            $pdf->Cell(0, 8, 'Budget Information', 0, 1, 'L');
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetTextColor(0, 0, 0);
            
            $usedAmount = $project->getEffectiveUsedAmount();
            $allocatedAmount = $project->allocated_amount ?? 0;
            $budgetData = [
                ['Allocated Budget', 'PHP ' . number_format($allocatedAmount, 2)],
                ['Amount Used', 'PHP ' . number_format($usedAmount, 2)],
                ['Remaining Budget', 'PHP ' . number_format(max(0, $allocatedAmount - $usedAmount), 2)],
                ['Budget Utilized', number_format(($allocatedAmount > 0 ? ($usedAmount / $allocatedAmount * 100) : 0), 2) . '%'],
            ];
            
            $pdf->SetFillColor(240, 240, 240);
            $fill = true;
            foreach ($budgetData as $row) {
                $pdf->Cell(80, 7, $row[0], 1, 0, 'L', $fill);
                $pdf->Cell(0, 7, $row[1], 1, 1, 'L', $fill);
                $fill = !$fill;
            }
            $pdf->Ln(5);
            
            // BILL OF QUANTITY SECTION
            if ($project->materials && $project->materials->count() > 0) {
                $pdf->AddPage();
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetTextColor(5, 150, 105);
                $pdf->Cell(0, 8, 'Bill of Quantity', 0, 1, 'L');
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                
                $pdf->SetFillColor(240, 240, 240);
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->Cell(50, 6, 'Item', 1, 0, 'L', true);
                $pdf->Cell(20, 6, 'Unit', 1, 0, 'L', true);
                $pdf->Cell(18, 6, 'Qty', 1, 0, 'C', true);
                $pdf->Cell(28, 6, 'Material', 1, 0, 'R', true);
                $pdf->Cell(25, 6, 'Labor', 1, 0, 'R', true);
                $pdf->Cell(28, 6, 'Total', 1, 1, 'R', true);
                
                $pdf->SetFont('helvetica', '', 7);
                $pdf->SetFillColor(255, 255, 255);
                $totalBOQ = 0;
                foreach ($project->materials as $material) {
                    $itemTotal = ($material->material_cost + $material->labor_cost) * $material->quantity;
                    $totalBOQ += $itemTotal;
                    
                    $pdf->Cell(50, 6, substr($material->item_name, 0, 30), 1, 0, 'L');
                    $pdf->Cell(20, 6, substr($material->unit, 0, 10), 1, 0, 'L');
                    $pdf->Cell(18, 6, $material->quantity, 1, 0, 'C');
                    $pdf->Cell(28, 6, 'PHP ' . number_format($material->material_cost, 2), 1, 0, 'R');
                    $pdf->Cell(25, 6, 'PHP ' . number_format($material->labor_cost, 2), 1, 0, 'R');
                    $pdf->Cell(28, 6, 'PHP ' . number_format($itemTotal, 2), 1, 1, 'R');
                }
                
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->SetFillColor(200, 220, 200);
                $pdf->Cell(50, 6, '', 1, 0, 'L', true);
                $pdf->Cell(20, 6, '', 1, 0, 'L', true);
                $pdf->Cell(18, 6, '', 1, 0, 'C', true);
                $pdf->Cell(28, 6, '', 1, 0, 'R', true);
                $pdf->Cell(25, 6, 'TOTAL:', 1, 0, 'R', true);
                $pdf->Cell(28, 6, 'PHP ' . number_format($totalBOQ, 2), 1, 1, 'R', true);
                $pdf->Ln(5);
            }
            
            // PURCHASE ORDERS SECTION
            if ($project->purchaseOrders && $project->purchaseOrders->count() > 0) {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetTextColor(5, 150, 105);
                $pdf->Cell(0, 8, 'Purchase Orders', 0, 1, 'L');
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                
                $pdf->SetFillColor(240, 240, 240);
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->Cell(35, 6, 'PO Number', 1, 0, 'L', true);
                $pdf->Cell(30, 6, 'Supplier', 1, 0, 'L', true);
                $pdf->Cell(25, 6, 'Amount', 1, 0, 'R', true);
                $pdf->Cell(25, 6, 'Status', 1, 0, 'L', true);
                $pdf->Cell(30, 6, 'Date', 1, 1, 'L', true);
                
                $pdf->SetFont('helvetica', '', 7);
                $pdf->SetFillColor(255, 255, 255);
                foreach ($project->purchaseOrders as $po) {
                    $pdf->Cell(35, 6, substr($po->po_number, 0, 15), 1, 0, 'L');
                    $pdf->Cell(30, 6, substr($po->supplier_name, 0, 20), 1, 0, 'L');
                    $pdf->Cell(25, 6, 'PHP ' . number_format($po->total_amount, 2), 1, 0, 'R');
                    $pdf->Cell(25, 6, $po->status, 1, 0, 'L');
                    $pdf->Cell(30, 6, $po->created_at->format('M d, Y'), 1, 1, 'L');
                }
                $pdf->Ln(5);
            }
            
            // EMPLOYEES SECTION
            if ($project->employees && $project->employees->count() > 0) {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetTextColor(5, 150, 105);
                $pdf->Cell(0, 8, 'Assigned Employees (' . $project->employees->count() . ')', 0, 1, 'L');
                $pdf->SetFont('helvetica', '', 9);
                $pdf->SetTextColor(0, 0, 0);
                
                $pdf->SetFillColor(240, 240, 240);
                $pdf->SetFont('helvetica', 'B', 9);
                $pdf->Cell(60, 7, 'Name', 1, 0, 'L', true);
                $pdf->Cell(50, 7, 'Position', 1, 0, 'L', true);
                $pdf->Cell(30, 7, 'Role', 1, 1, 'L', true);
                
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetFillColor(255, 255, 255);
                foreach ($project->employees as $emp) {
                    // Get employee name from f_name and l_name
                    $firstName = $emp->f_name ?? '';
                    $lastName = $emp->l_name ?? '';
                    $name = trim("{$firstName} {$lastName}") ?: 'N/A';
                    
                    $position = $emp->position ?? 'N/A';
                    $role = $emp->user?->role ?? 'N/A';
                    
                    $pdf->Cell(60, 7, substr($name, 0, 30), 1, 0, 'L');
                    $pdf->Cell(50, 7, substr($position, 0, 25), 1, 0, 'L');
                    $pdf->Cell(30, 7, $role, 1, 1, 'L');
                }
                $pdf->Ln(5);
            }
            
            // PROJECT UPDATES SECTION
            if ($project->updates && $project->updates->count() > 0) {
                $pdf->AddPage();
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetTextColor(5, 150, 105);
                $pdf->Cell(0, 8, 'Project Tasks & Updates (' . $project->updates->count() . ')', 0, 1, 'L');
                $pdf->SetFont('helvetica', '', 9);
                $pdf->SetTextColor(0, 0, 0);
                
                $pdf->SetFillColor(240, 240, 240);
                $pdf->SetFont('helvetica', 'B', 9);
                $pdf->Cell(35, 7, 'Date', 1, 0, 'L', true);
                $pdf->Cell(30, 7, 'Title', 1, 0, 'L', true);
                $pdf->Cell(0, 7, 'Description', 1, 1, 'L', true);
                
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetFillColor(255, 255, 255);
                foreach ($project->updates as $update) {
                    $date = $update->created_at->format('M d, Y');
                    $title = substr($update->title ?? $update->update_description ?? '', 0, 30);
                    $desc = substr($update->description ?? $update->update_description ?? '', 0, 80);
                    $pdf->Cell(35, 7, $date, 1, 0, 'L');
                    $pdf->Cell(30, 7, $title, 1, 0, 'L');
                    $pdf->MultiCell(0, 7, $desc, 1, 'L');
                }
            }
            
            $pdfContent = $pdf->Output('', 'S');
            return response()->streamDownload(
                fn () => print($pdfContent),
                "project_{$project->project_name}.pdf",
                ['Content-Type' => 'application/pdf']
            );
        } catch (\Exception $e) {
            \Log::error('PDF generation error: ' . $e->getMessage());
            return back()->with('error', 'PDF generation failed: ' . $e->getMessage());
        }
    }

    /**
     * Generate and download project report as CSV
     */
    public function downloadProjectCsv($projectId)
    {
        $project = Project::with(['employees', 'documents', 'updates'])->findOrFail($projectId);

        $filename = 'project_' . preg_replace('/[^A-Za-z0-9_-]+/', '_', $project->project_name) . '_report_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($project) {
            $output = fopen('php://output', 'w');

            // Section: Project Details
            fputcsv($output, ['Section', 'Field', 'Value']);
            fputcsv($output, ['Project Details', 'Project Name', $project->project_name]);
            fputcsv($output, ['Project Details', 'Client', $project->client_name]);
            fputcsv($output, ['Project Details', 'Lead', $project->lead]);
            fputcsv($output, ['Project Details', 'Inspector', 'N/A']);
            fputcsv($output, ['Project Details', 'Status', $project->status]);
            fputcsv($output, ['Project Details', 'Archived At', optional($project->archived_at)->toDateTimeString()]);

            // Blank line
            fputcsv($output, ['']);

            // Section: Employees
            fputcsv($output, ['Employees']);
            fputcsv($output, ['Full Name', 'Position']);
            foreach ($project->employees as $emp) {
                fputcsv($output, [
                    $emp->f_name . ' ' . $emp->l_name,
                    $emp->position,
                ]);
            }

            // Blank line
            fputcsv($output, ['']);

            // Section: Project Updates
            if ($project->updates && $project->updates->count() > 0) {
                fputcsv($output, ['Project Updates']);
                fputcsv($output, ['Title', 'Description', 'Status', 'Updated Date', 'Updated By']);
                foreach ($project->updates as $update) {
                    fputcsv($output, [
                        $update->title,
                        $update->description,
                        $update->status,
                        $update->created_at->format('M d, Y H:i'),
                        $update->updatedBy?->name ?? 'Unknown',
                    ]);
                }
                fputcsv($output, ['']);
            }

            // Section: Documentation Images
            if ($project->documents && $project->documents->count() > 0) {
                fputcsv($output, ['Documentation Images']);
                fputcsv($output, ['Title', 'Uploaded Date', 'Uploaded By', 'File Size (KB)', 'Mime Type']);
                foreach ($project->documents as $doc) {
                    fputcsv($output, [
                        $doc->title,
                        $doc->created_at->format('M d, Y H:i'),
                        $doc->uploader?->name ?? 'Unknown',
                        number_format($doc->file_size / 1024, 2),
                        $doc->mime_type,
                    ]);
                }
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Generate and download BOQ (Bill of Quantity) as PDF using Blade template
     */
    public function downloadBOQ($projectId)
    {
        $project = Project::with(['materials', 'client', 'assignedPM'])->findOrFail($projectId);

        try {
            $pdf = Pdf::loadView('pdfs.boq-report', ['project' => $project])
                ->setPaper('a4', 'portrait')
                ->setOption('margin-top', 5)
                ->setOption('margin-right', 5)
                ->setOption('margin-bottom', 5)
                ->setOption('margin-left', 5)
                ->setOption('enable-local-file-access', true);

            $filename = 'BOQ_' . preg_replace('/[^A-Za-z0-9_-]+/', '_', $project->project_name) . '_' . now()->format('Ymd_His') . '.pdf';
            return $pdf->download($filename);
        } catch (\Exception $e) {
            \Log::error('BOQ PDF generation error: ' . $e->getMessage());
            return back()->with('error', 'BOQ PDF generation failed: ' . $e->getMessage());
        }
    }
}
