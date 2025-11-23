<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Generate and download invoice PDF
     */
    public function downloadInvoice($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);

        $pdf = Pdf::loadView('pdfs.invoice', ['invoice' => $invoice])
            ->setPaper('a4')
            ->setOption('margin-top', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10);

        return $pdf->download("invoice_{$invoice->invoice_number}.pdf");
    }

    /**
     * Generate and download transaction report PDF
     */
    public function downloadTransactionReport(Request $request)
    {
        $filters = [
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
            'status' => $request->get('status'),
        ];

        $pdf = Pdf::loadView('pdfs.transaction-report', ['filters' => $filters])
            ->setPaper('a4', 'landscape')
            ->setOption('margin-top', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10);

        $filename = 'transaction_report_' . now()->format('Y-m-d_His') . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Generate and download project report PDF
     */
    public function downloadProjectReport($projectId)
    {
        $project = Project::with(['employees', 'projectRecords'])->findOrFail($projectId);

        $pdf = Pdf::loadView('pdfs.project-report', ['project' => $project])
            ->setPaper('a4')
            ->setOption('margin-top', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10);

        return $pdf->download("project_{$project->project_name}.pdf");
    }

    /**
     * Generate and download project report as CSV
     */
    public function downloadProjectCsv($projectId)
    {
        $project = Project::with(['employees', 'projectRecords.materials'])->findOrFail($projectId);

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
            $inspector = optional($project->projectRecords->first())->inspector;
            fputcsv($output, ['Project Details', 'Inspector', $inspector]);
            fputcsv($output, ['Project Details', 'Status', $project->status]);
            fputcsv($output, ['Project Details', 'Archived At', optional($project->archived_at)->toDateTimeString()]);

            // Blank line
            fputcsv($output, ['']);

            // Section: Materials
            fputcsv($output, ['Materials']);
            fputcsv($output, ['Name', 'Quantity', 'Unit', 'Unit Price', 'Total', 'Supplier', 'Date Received', 'Status']);
            $materials = collect();
            foreach (($project->projectRecords ?? []) as $rec) {
                $materials = $materials->merge($rec->materials);
            }
            foreach ($materials as $m) {
                fputcsv($output, [
                    $m->name,
                    $m->quantity,
                    $m->unit,
                    $m->price,
                    $m->total,
                    $m->supplier,
                    $m->date_received,
                    $m->status,
                ]);
            }
            $materialsTotal = $materials->sum('total');
            fputcsv($output, ['']);
            fputcsv($output, ['Materials Total', '', '', '', $materialsTotal]);

            // Blank line
            fputcsv($output, ['']);

            // Section: Employees
            fputcsv($output, ['Employees']);
            fputcsv($output, ['Full Name', 'Position']);
            foreach ($project->employees as $emp) {
                fputcsv($output, [
                    $emp->full_name,
                    $emp->position,
                ]);
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Generate and download attendance report PDF
     */
    public function downloadAttendanceReport(Request $request)
    {
        $filters = [
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
            'project_id' => $request->get('project_id'),
        ];

        $pdf = Pdf::loadView('pdfs.attendance-report', ['filters' => $filters])
            ->setPaper('a4', 'landscape')
            ->setOption('margin-top', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10);

        $filename = 'attendance_report_' . now()->format('Y-m-d_His') . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Generate and download finance summary PDF
     */
    public function downloadFinanceSummary()
    {
        $pdf = Pdf::loadView('pdfs.finance-summary')
            ->setPaper('a4')
            ->setOption('margin-top', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10);

        $filename = 'finance_summary_' . now()->format('Y-m-d_His') . '.pdf';
        return $pdf->download($filename);
    }
}
