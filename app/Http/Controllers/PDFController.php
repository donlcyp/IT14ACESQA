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
            $pdf->SetCreator('ACES AJJ CRISBER Engineering Services');
            $pdf->SetAuthor('ACES AJJ CRISBER');
            $pdf->SetTitle('Accomplishment Report - ' . $project->project_name);
            $pdf->SetSubject('Project Accomplishment Report');
            $pdf->SetMargins(15, 15, 15);
            
            $pdf->AddPage();
            
            // ===== HEADER SECTION =====
            $pdf->SetFont('helvetica', 'B', 18);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell(0, 10, 'ACES AJJ CRISBER', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell(0, 5, 'AJJ CRISBER ENGINEERING SERVICES', 0, 1, 'C');
            $pdf->SetFont('helvetica', '', 8);
            $pdf->Cell(0, 4, 'Fire Protection | Sanitary Plumbing | Fire Alarm | Design & Build', 0, 1, 'C');
            
            $pdf->Ln(3);
            $pdf->SetLineWidth(0.5);
            $pdf->SetDrawColor(209, 213, 219);
            $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
            $pdf->Ln(6);
            
            // Document Title
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell(0, 8, 'PROJECT ACCOMPLISHMENT REPORT', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell(0, 5, 'Document Generated: ' . now()->format('F d, Y \a\t h:i A'), 0, 1, 'C');
            $pdf->Ln(8);
            
            // ===== PROJECT INFORMATION SECTION =====
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->SetTextColor(55, 65, 81);
            $pdf->SetFillColor(243, 244, 246);
            $pdf->Cell(0, 7, ' PROJECT INFORMATION', 0, 1, 'L', true);
            $pdf->Ln(2);
            
            // Get client name
            $clientName = 'N/A';
            if ($project->client && $project->client->company_name) {
                $clientName = $project->client->company_name;
            } elseif ($project->client_first_name || $project->client_last_name) {
                $clientName = trim(($project->client_first_name ?? '') . ' ' . ($project->client_last_name ?? ''));
            }
            
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(31, 41, 55);
            
            // Project details in two columns
            $leftX = 15;
            $rightX = 110;
            $labelWidth = 35;
            $valueWidth = 55;
            
            $pdf->SetX($leftX);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($labelWidth, 5, 'Project Name:', 0, 0, 'L');
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell($valueWidth, 5, $project->project_name, 0, 0, 'L');
            
            $pdf->SetX($rightX);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($labelWidth, 5, 'Project Code:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell($valueWidth, 5, $project->project_code ?? 'N/A', 0, 1, 'L');
            
            $pdf->SetX($leftX);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($labelWidth, 5, 'Client:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell($valueWidth, 5, $clientName, 0, 0, 'L');
            
            $pdf->SetX($rightX);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($labelWidth, 5, 'Location:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell($valueWidth, 5, $project->location ?? 'N/A', 0, 1, 'L');
            
            $pdf->SetX($leftX);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($labelWidth, 5, 'Project Manager:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell($valueWidth, 5, $project->assignedPM?->name ?? 'N/A', 0, 0, 'L');
            
            $pdf->SetX($rightX);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($labelWidth, 5, 'Project Type:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell($valueWidth, 5, $project->project_type ?? 'N/A', 0, 1, 'L');
            
            $pdf->Ln(4);
            
            // ===== PROJECT TIMELINE SECTION =====
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->SetTextColor(55, 65, 81);
            $pdf->SetFillColor(243, 244, 246);
            $pdf->Cell(0, 7, ' PROJECT TIMELINE', 0, 1, 'L', true);
            $pdf->Ln(2);
            
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(31, 41, 55);
            
            $pdf->SetX($leftX);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($labelWidth, 5, 'Start Date:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell($valueWidth, 5, $project->date_started ? $project->date_started->format('F d, Y') : 'N/A', 0, 0, 'L');
            
            $pdf->SetX($rightX);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($labelWidth, 5, 'Target Date:', 0, 0, 'L');
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell($valueWidth, 5, $project->target_timeline ? $project->target_timeline->format('F d, Y') : 'N/A', 0, 1, 'L');
            
            $pdf->SetX($leftX);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($labelWidth, 5, 'Completion Date:', 0, 0, 'L');
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetTextColor(22, 163, 74);
            $pdf->Cell($valueWidth, 5, $project->date_ended ? $project->date_ended->format('F d, Y') : 'N/A', 0, 0, 'L');
            
            $pdf->SetX($rightX);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($labelWidth, 5, 'Status:', 0, 0, 'L');
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetTextColor($project->status === 'Completed' ? 22 : 31, $project->status === 'Completed' ? 163 : 41, $project->status === 'Completed' ? 74 : 55);
            $pdf->Cell($valueWidth, 5, $project->status ?? 'N/A', 0, 1, 'L');
            
            // Calculate duration
            if ($project->date_started && $project->date_ended) {
                $duration = $project->date_started->diffInDays($project->date_ended);
                $pdf->SetX($leftX);
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetTextColor(107, 114, 128);
                $pdf->Cell($labelWidth, 5, 'Total Duration:', 0, 0, 'L');
                $pdf->SetFont('helvetica', '', 9);
                $pdf->SetTextColor(31, 41, 55);
                $pdf->Cell($valueWidth, 5, $duration . ' days', 0, 1, 'L');
            }
            
            $pdf->Ln(4);
            
            // ===== FINANCIAL SUMMARY SECTION =====
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->SetTextColor(55, 65, 81);
            $pdf->SetFillColor(243, 244, 246);
            $pdf->Cell(0, 7, ' FINANCIAL SUMMARY', 0, 1, 'L', true);
            $pdf->Ln(2);
            
            $usedAmount = $project->getEffectiveUsedAmount();
            $allocatedAmount = $project->allocated_amount ?? 0;
            $remaining = max(0, $allocatedAmount - $usedAmount);
            $percentUsed = $allocatedAmount > 0 ? ($usedAmount / $allocatedAmount * 100) : 0;
            
            // Financial metrics in a table format
            $pdf->SetFillColor(249, 250, 251);
            $colWidth = 45;
            
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell($colWidth, 5, 'Allocated Budget', 1, 0, 'C', true);
            $pdf->Cell($colWidth, 5, 'Amount Used', 1, 0, 'C', true);
            $pdf->Cell($colWidth, 5, 'Remaining', 1, 0, 'C', true);
            $pdf->Cell($colWidth, 5, 'Utilization', 1, 1, 'C', true);
            
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell($colWidth, 6, 'PHP ' . number_format($allocatedAmount, 2), 1, 0, 'C');
            $pdf->Cell($colWidth, 6, 'PHP ' . number_format($usedAmount, 2), 1, 0, 'C');
            $pdf->SetTextColor($remaining > 0 ? 22 : 220, $remaining > 0 ? 163 : 38, $remaining > 0 ? 74 : 38);
            $pdf->Cell($colWidth, 6, 'PHP ' . number_format($remaining, 2), 1, 0, 'C');
            $pdf->SetTextColor($percentUsed <= 100 ? 22 : 220, $percentUsed <= 100 ? 163 : 38, $percentUsed <= 100 ? 74 : 38);
            $pdf->Cell($colWidth, 6, number_format($percentUsed, 1) . '%', 1, 1, 'C');
            
            $pdf->Ln(4);
            
            // ===== SCOPE OF WORK / ACCOMPLISHMENTS =====
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->SetTextColor(55, 65, 81);
            $pdf->SetFillColor(243, 244, 246);
            $pdf->Cell(0, 7, ' SCOPE OF WORK ACCOMPLISHED', 0, 1, 'L', true);
            $pdf->Ln(2);
            
            // Calculate BOQ statistics
            $materials = $project->materials ?? collect();
            $totalItems = $materials->count();
            $passedItems = $materials->filter(fn($m) => strtolower($m->qa_status ?? '') === 'passed')->count();
            $failedItems = $materials->filter(fn($m) => strtolower($m->qa_status ?? '') === 'failed')->count();
            
            if ($totalItems > 0) {
                $pdf->SetFont('helvetica', '', 9);
                $pdf->SetTextColor(31, 41, 55);
                
                $pdf->SetX($leftX);
                $pdf->Cell(0, 5, 'Total BOQ Items: ' . $totalItems . ' | QA Passed: ' . $passedItems . ' | QA Failed: ' . $failedItems, 0, 1, 'L');
                $pdf->Ln(2);
                
                // List key materials/scope items
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->SetTextColor(107, 114, 128);
                $pdf->Cell(80, 5, 'Item Description', 1, 0, 'L', true);
                $pdf->Cell(20, 5, 'Qty', 1, 0, 'C', true);
                $pdf->Cell(20, 5, 'Unit', 1, 0, 'C', true);
                $pdf->Cell(30, 5, 'Amount', 1, 0, 'R', true);
                $pdf->Cell(30, 5, 'QA Status', 1, 1, 'C', true);
                
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetTextColor(31, 41, 55);
                $totalAmount = 0;
                $displayCount = 0;
                
                foreach ($materials->take(15) as $material) {
                    $itemTotal = (($material->material_cost ?? 0) + ($material->labor_cost ?? 0)) * ($material->quantity ?? 0);
                    $totalAmount += $itemTotal;
                    $displayCount++;
                    
                    $qaStatus = ucfirst($material->qa_status ?? 'Pending');
                    $itemName = $material->item_description ?? $material->material_name ?? 'N/A';
                    
                    $pdf->Cell(80, 5, substr($itemName, 0, 45), 1, 0, 'L');
                    $pdf->Cell(20, 5, $material->quantity ?? 0, 1, 0, 'C');
                    $pdf->Cell(20, 5, $material->unit ?? '-', 1, 0, 'C');
                    $pdf->Cell(30, 5, number_format($itemTotal, 2), 1, 0, 'R');
                    
                    // Color code QA status
                    if (strtolower($qaStatus) === 'passed') {
                        $pdf->SetTextColor(22, 163, 74);
                    } elseif (strtolower($qaStatus) === 'failed') {
                        $pdf->SetTextColor(220, 38, 38);
                    } else {
                        $pdf->SetTextColor(107, 114, 128);
                    }
                    $pdf->Cell(30, 5, $qaStatus, 1, 1, 'C');
                    $pdf->SetTextColor(31, 41, 55);
                }
                
                if ($totalItems > 15) {
                    $pdf->SetFont('helvetica', 'I', 8);
                    $pdf->SetTextColor(107, 114, 128);
                    $pdf->Cell(0, 5, '... and ' . ($totalItems - 15) . ' more items (see full BOQ report)', 0, 1, 'L');
                }
            } else {
                $pdf->SetFont('helvetica', 'I', 9);
                $pdf->SetTextColor(107, 114, 128);
                $pdf->Cell(0, 5, 'No items recorded in Bill of Quantities', 0, 1, 'L');
            }
            
            $pdf->Ln(4);
            
            // ===== TASKS / ACTIVITIES COMPLETED =====
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->SetTextColor(55, 65, 81);
            $pdf->SetFillColor(243, 244, 246);
            $pdf->Cell(0, 7, ' TASKS & ACTIVITIES COMPLETED', 0, 1, 'L', true);
            $pdf->Ln(2);
            
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(31, 41, 55);
            
            if ($project->updates && $project->updates->count() > 0) {
                $completedUpdates = $project->updates->where('status', 'Completed');
                $allUpdates = $project->updates;
                
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetTextColor(107, 114, 128);
                $pdf->Cell(0, 5, 'Total Tasks: ' . $allUpdates->count() . ' | Completed: ' . $completedUpdates->count(), 0, 1, 'L');
                $pdf->Ln(2);
                
                if ($completedUpdates->count() > 0) {
                    $pdf->SetFont('helvetica', 'B', 8);
                    $pdf->SetFillColor(249, 250, 251);
                    $pdf->Cell(70, 5, 'Task', 1, 0, 'L', true);
                    $pdf->Cell(60, 5, 'Description', 1, 0, 'L', true);
                    $pdf->Cell(25, 5, 'Completed', 1, 0, 'C', true);
                    $pdf->Cell(25, 5, 'By', 1, 1, 'C', true);
                    
                    $pdf->SetFont('helvetica', '', 8);
                    $pdf->SetTextColor(31, 41, 55);
                    
                    foreach ($completedUpdates->take(10) as $update) {
                        $pdf->Cell(70, 5, substr($update->title, 0, 40), 1, 0, 'L');
                        $pdf->Cell(60, 5, substr($update->description ?? '-', 0, 35), 1, 0, 'L');
                        $pdf->Cell(25, 5, $update->updated_at->format('M d, Y'), 1, 0, 'C');
                        $pdf->Cell(25, 5, substr($update->updatedBy?->name ?? 'System', 0, 12), 1, 1, 'C');
                    }
                    
                    if ($completedUpdates->count() > 10) {
                        $pdf->SetFont('helvetica', 'I', 8);
                        $pdf->SetTextColor(107, 114, 128);
                        $pdf->Cell(0, 5, '... and ' . ($completedUpdates->count() - 10) . ' more completed tasks', 0, 1, 'L');
                    }
                } else {
                    $pdf->SetFont('helvetica', 'I', 9);
                    $pdf->SetTextColor(107, 114, 128);
                    $pdf->Cell(0, 5, 'No completed tasks recorded', 0, 1, 'L');
                }
            } else {
                $pdf->SetFont('helvetica', 'I', 9);
                $pdf->SetTextColor(107, 114, 128);
                $pdf->Cell(0, 5, 'No tasks recorded for this project', 0, 1, 'L');
            }
            
            // ===== TEAM MEMBERS SECTION =====
            if ($project->employees && $project->employees->count() > 0) {
                $pdf->AddPage();
                
                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->SetTextColor(55, 65, 81);
                $pdf->SetFillColor(243, 244, 246);
                $pdf->Cell(0, 7, ' PROJECT TEAM (' . ($project->employees->count() + 1) . ' Members)', 0, 1, 'L', true);
                $pdf->Ln(2);
                
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->SetFillColor(249, 250, 251);
                $pdf->SetTextColor(107, 114, 128);
                $pdf->Cell(50, 5, 'Name', 1, 0, 'L', true);
                $pdf->Cell(45, 5, 'Position', 1, 0, 'L', true);
                $pdf->Cell(35, 5, 'Role', 1, 0, 'L', true);
                $pdf->Cell(50, 5, 'Contact', 1, 1, 'L', true);
                
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetTextColor(31, 41, 55);
                
                // Add Project Manager first
                if ($project->assignedPM) {
                    $pdf->SetFillColor(236, 253, 245);
                    $pdf->Cell(50, 5, $project->assignedPM->name ?? 'N/A', 1, 0, 'L', true);
                    $pdf->Cell(45, 5, 'Project Manager', 1, 0, 'L', true);
                    $pdf->Cell(35, 5, 'PM', 1, 0, 'L', true);
                    $pdf->Cell(50, 5, $project->assignedPM->email ?? '-', 1, 1, 'L', true);
                }
                
                $pdf->SetFillColor(255, 255, 255);
                foreach ($project->employees as $emp) {
                    $firstName = $emp->f_name ?? '';
                    $lastName = $emp->l_name ?? '';
                    $name = trim("{$firstName} {$lastName}") ?: 'N/A';
                    
                    $pdf->Cell(50, 5, substr($name, 0, 28), 1, 0, 'L');
                    $pdf->Cell(45, 5, substr($emp->position ?? 'N/A', 0, 25), 1, 0, 'L');
                    $pdf->Cell(35, 5, $emp->user?->role ?? 'Worker', 1, 0, 'L');
                    $pdf->Cell(50, 5, $emp->user?->email ?? '-', 1, 1, 'L');
                }
            }
            
            // ===== SIGNATURE SECTION =====
            $pdf->Ln(15);
            $pdf->SetLineWidth(0.3);
            $pdf->SetDrawColor(209, 213, 219);
            $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
            $pdf->Ln(10);
            
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell(90, 6, 'Prepared by:', 0, 0, 'L');
            $pdf->Cell(90, 6, 'Approved by:', 0, 1, 'L');
            
            $pdf->Ln(12);
            
            $pdf->SetLineWidth(0.3);
            $pdf->SetDrawColor(31, 41, 55);
            $pdf->Line(15, $pdf->GetY(), 85, $pdf->GetY());
            $pdf->Line(115, $pdf->GetY(), 185, $pdf->GetY());
            $pdf->Ln(2);
            
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetTextColor(31, 41, 55);
            $pdf->Cell(90, 5, $project->assignedPM?->name ?? 'Project Manager', 0, 0, 'C');
            $pdf->Cell(90, 5, 'CRISBEN B. BERIONG', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell(90, 4, 'Project Manager', 0, 0, 'C');
            $pdf->Cell(90, 4, 'General Manager', 0, 1, 'C');
            
            $pdf->Ln(8);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetTextColor(107, 114, 128);
            $pdf->Cell(90, 4, 'Date: _______________', 0, 0, 'C');
            $pdf->Cell(90, 4, 'Date: _______________', 0, 1, 'C');
            
            // Footer
            $pdf->Ln(15);
            $pdf->SetLineWidth(0.3);
            $pdf->SetDrawColor(209, 213, 219);
            $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
            $pdf->Ln(3);
            
            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetTextColor(156, 163, 175);
            $pdf->Cell(0, 4, 'This document is computer-generated by ACES AJJ CRISBER Engineering Services Management System.', 0, 1, 'C');
            $pdf->Cell(0, 4, 'Document ID: RPT-' . $project->id . '-' . now()->format('YmdHis'), 0, 1, 'C');
            
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
