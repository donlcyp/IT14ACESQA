<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Elibyy\TCPDF\TCPDF;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    /**
     * Generate and download project report PDF in Accomplishment Report format
     */
    public function downloadProjectReport($projectId)
    {
        $project = Project::with([
            'employees.user', 
            'documents', 
            'updates', 
            'client', 
            'materials', 
            'assignedPM'
        ])->findOrFail($projectId);

        try {
            $pdf = app('tcpdf');
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 10);
            
            // Professional Header with Line
            $pdf->SetLineWidth(0.5);
            $pdf->SetDrawColor(200, 0, 0);
            $pdf->SetFillColor(255, 0, 0);
            $pdf->Cell(0, 2, '', 0, 1, 'C', true); // Red line
            
            $pdf->SetFont('helvetica', 'B', 18);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(0, 12, 'ACCOMPLISHMENT REPORT', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', '', 11);
            $pdf->SetTextColor(80, 80, 80);
            $pdf->Cell(0, 7, $project->project_name, 0, 1, 'C');
            
            $pdf->SetDrawColor(200, 0, 0);
            $pdf->SetLineWidth(0.5);
            $pdf->Cell(0, 2, '', 0, 1, 'C', true); // Red line
            $pdf->Ln(5);
            
            // PROJECT DETAILS SECTION with border
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFillColor(41, 84, 159);
            $pdf->Cell(0, 8, 'PROJECT DETAILS', 0, 1, 'L', true);
            
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(0, 0, 0);
            
            // Get client name
            $clientName = 'N/A';
            if ($project->client && $project->client->company_name) {
                $clientName = $project->client->company_name;
            } elseif ($project->client_first_name || $project->client_last_name) {
                $clientName = trim(($project->client_first_name ?? '') . ' ' . ($project->client_last_name ?? ''));
            }
            
            // Left and Right columns
            $pdf->SetX(15);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetTextColor(41, 84, 159);
            $pdf->Cell(45, 6, 'Project Name:', 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(55, 6, $project->project_name, 0, 0, 'L');
            
            $pdf->SetTextColor(41, 84, 159);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(30, 6, 'Status:', 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(0, 6, $project->pm_status ?? $project->status ?? 'N/A', 0, 1, 'L');
            
            $pdf->SetX(15);
            $pdf->SetTextColor(41, 84, 159);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(45, 6, 'Client:', 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(55, 6, $clientName, 0, 0, 'L');
            
            $pdf->SetTextColor(41, 84, 159);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(30, 6, 'Start Date:', 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(0, 6, $project->date_started ? $project->date_started->format('M d, Y') : 'N/A', 0, 1, 'L');
            
            $pdf->SetX(15);
            $pdf->SetTextColor(41, 84, 159);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(45, 6, 'Location:', 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(55, 6, $project->location ?? 'N/A', 0, 0, 'L');
            
            $pdf->SetTextColor(41, 84, 159);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(30, 6, 'End Date:', 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(0, 6, $project->date_ended ? $project->date_ended->format('M d, Y') : 'N/A', 0, 1, 'L');
            
            $pdf->SetX(15);
            $pdf->SetTextColor(41, 84, 159);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(45, 6, 'Project Manager:', 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(55, 6, $project->assignedPM?->name ?? 'N/A', 0, 0, 'L');
            
            $pdf->SetTextColor(41, 84, 159);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(30, 6, 'Target Date:', 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(0, 6, $project->target_timeline ? $project->target_timeline->format('M d, Y') : 'N/A', 0, 1, 'L');
            
            $pdf->Ln(6);
            
            // BUDGET SECTION
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFillColor(41, 84, 159);
            $pdf->Cell(0, 8, 'BUDGET INFORMATION', 0, 1, 'L', true);
            
            $usedAmount = $project->getEffectiveUsedAmount();
            $allocatedAmount = $project->allocated_amount ?? 0;
            
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFillColor(240, 245, 250);
            
            $pdf->SetX(15);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(45, 6, 'Allocated Budget:', 0, 0, 'L', true);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(0, 6, 'PHP ' . number_format($allocatedAmount, 2), 0, 1, 'L', true);
            
            $pdf->SetX(15);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(45, 6, 'Amount Used:', 0, 0, 'L', false);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(0, 6, 'PHP ' . number_format($usedAmount, 2), 0, 1, 'L', false);
            
            $pdf->SetX(15);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(45, 6, 'Remaining Budget:', 0, 0, 'L', true);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(0, 6, 'PHP ' . number_format(max(0, $allocatedAmount - $usedAmount), 2), 0, 1, 'L', true);
            
            $pdf->SetX(15);
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(45, 6, 'Budget Utilized:', 0, 0, 'L', false);
            $percentUsed = $allocatedAmount > 0 ? ($usedAmount / $allocatedAmount * 100) : 0;
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(0, 6, number_format($percentUsed, 2) . '%', 0, 1, 'L', false);
            
            $pdf->Ln(6);
            
            // DAILY ACTIVITIES/ACCOMPLISHMENTS SECTION
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFillColor(41, 84, 159);
            $pdf->Cell(0, 8, 'DAILY ACTIVITIES / TASKS / ACCOMPLISHMENTS / LEARNINGS', 0, 1, 'L', true);
            
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(0, 0, 0);
            
            if ($project->updates && $project->updates->count() > 0) {
                $completedUpdates = $project->updates->where('status', 'Completed');
                if ($completedUpdates->count() > 0) {
                    $pdf->SetFillColor(240, 245, 250);
                    foreach ($completedUpdates as $update) {
                        $pdf->SetX(15);
                        $pdf->SetFont('helvetica', 'B', 9);
                        $pdf->SetTextColor(41, 84, 159);
                        $pdf->Cell(0, 6, '• ' . $update->title . ' (' . $update->created_at->format('M d, Y') . ')', 0, 1, 'L');
                        
                        $pdf->SetX(20);
                        $pdf->SetFont('helvetica', '', 8);
                        $pdf->SetTextColor(0, 0, 0);
                        $pdf->MultiCell(0, 5, $update->description, 0, 'L');
                        $pdf->Ln(2);
                    }
                } else {
                    $pdf->SetX(15);
                    $pdf->SetFont('helvetica', '', 9);
                    $pdf->SetTextColor(100, 100, 100);
                    $pdf->Cell(0, 6, 'No completed tasks', 0, 1, 'L');
                }
            } else {
                $pdf->SetX(15);
                $pdf->SetFont('helvetica', '', 9);
                $pdf->SetTextColor(100, 100, 100);
                $pdf->Cell(0, 6, 'No activities recorded', 0, 1, 'L');
            }
            
            // Add page for Bill of Quantity if exists
            if ($project->materials && $project->materials->count() > 0) {
                $pdf->AddPage();
                $pdf->SetFont('helvetica', 'B', 11);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->SetFillColor(41, 84, 159);
                $pdf->Cell(0, 8, 'BILL OF QUANTITY', 0, 1, 'L', true);
                $pdf->SetFont('helvetica', '', 8);
                
                $pdf->SetFillColor(200, 220, 240);
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(50, 6, 'Item', 1, 0, 'L', true);
                $pdf->Cell(20, 6, 'Unit', 1, 0, 'L', true);
                $pdf->Cell(18, 6, 'Qty', 1, 0, 'C', true);
                $pdf->Cell(28, 6, 'Material', 1, 0, 'R', true);
                $pdf->Cell(25, 6, 'Labor', 1, 0, 'R', true);
                $pdf->Cell(28, 6, 'Total', 1, 1, 'R', true);
                
                $pdf->SetFont('helvetica', '', 7);
                $pdf->SetFillColor(255, 255, 255);
                $totalBOQ = 0;
                $fill = false;
                foreach ($project->materials as $material) {
                    $itemTotal = ($material->material_cost + $material->labor_cost) * $material->quantity;
                    $totalBOQ += $itemTotal;
                    
                    if ($fill) $pdf->SetFillColor(240, 245, 250);
                    else $pdf->SetFillColor(255, 255, 255);
                    
                    $itemName = $material->item_description ?? $material->material_name ?? $material->name ?? 'N/A';
                    $pdf->Cell(50, 6, substr($itemName, 0, 30), 1, 0, 'L', $fill);
                    $pdf->Cell(20, 6, substr($material->unit, 0, 10), 1, 0, 'L', $fill);
                    $pdf->Cell(18, 6, $material->quantity, 1, 0, 'C', $fill);
                    $pdf->Cell(28, 6, 'PHP ' . number_format($material->material_cost, 2), 1, 0, 'R', $fill);
                    $pdf->Cell(25, 6, 'PHP ' . number_format($material->labor_cost, 2), 1, 0, 'R', $fill);
                    $pdf->Cell(28, 6, 'PHP ' . number_format($itemTotal, 2), 1, 1, 'R', $fill);
                    
                    $fill = !$fill;
                }
                
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->SetFillColor(200, 220, 240);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(50, 6, '', 1, 0, 'L', true);
                $pdf->Cell(20, 6, '', 1, 0, 'L', true);
                $pdf->Cell(18, 6, '', 1, 0, 'C', true);
                $pdf->Cell(28, 6, '', 1, 0, 'R', true);
                $pdf->Cell(25, 6, 'TOTAL:', 1, 0, 'R', true);
                $pdf->Cell(28, 6, 'PHP ' . number_format($totalBOQ, 2), 1, 1, 'R', true);
            }
            
            // Add page for Employees if exist
            if ($project->employees && $project->employees->count() > 0) {
                $pdf->AddPage();
                $pdf->SetFont('helvetica', 'B', 11);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->SetFillColor(41, 84, 159);
                $pdf->Cell(0, 8, 'ASSIGNED EMPLOYEES (' . $project->employees->count() . ')', 0, 1, 'L', true);
                $pdf->SetFont('helvetica', '', 9);
                
                $pdf->SetFillColor(200, 220, 240);
                $pdf->SetFont('helvetica', 'B', 9);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(60, 7, 'Name', 1, 0, 'L', true);
                $pdf->Cell(50, 7, 'Position', 1, 0, 'L', true);
                $pdf->Cell(30, 7, 'Role', 1, 1, 'L', true);
                
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetFillColor(255, 255, 255);
                $fill = false;
                foreach ($project->employees as $emp) {
                    $firstName = $emp->f_name ?? '';
                    $lastName = $emp->l_name ?? '';
                    $name = trim("{$firstName} {$lastName}") ?: 'N/A';
                    
                    $position = $emp->position ?? 'N/A';
                    $role = $emp->user?->role ?? 'N/A';
                    
                    if ($fill) $pdf->SetFillColor(240, 245, 250);
                    else $pdf->SetFillColor(255, 255, 255);
                    
                    $pdf->Cell(60, 7, substr($name, 0, 30), 1, 0, 'L', $fill);
                    $pdf->Cell(50, 7, substr($position, 0, 25), 1, 0, 'L', $fill);
                    $pdf->Cell(30, 7, $role, 1, 1, 'L', $fill);
                    
                    $fill = !$fill;
                }
            }
            
            return $pdf->Output('accomplishment-report-' . $projectId . '.pdf', 'D');
        } catch (\Exception $e) {
            return back()->with('error', 'PDF Generation Error: ' . $e->getMessage());
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
