<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display activity logs (OWNER only)
     */
    public function index(Request $request)
    {
        // Only OWNER can view logs
        if (Auth::user()?->role !== 'OWNER') {
            abort(403, 'Unauthorized');
        }

        $logs = Log::with('user')
            ->orderBy('log_date', 'desc')
            ->paginate(50);

        return view('logs.index', compact('logs'));
    }

    /**
     * Filter logs by user
     */
    public function filterByUser(Request $request)
    {
        if (Auth::user()?->role !== 'OWNER') {
            abort(403, 'Unauthorized');
        }

        $userId = $request->query('user_id');
        $action = $request->query('action');

        $query = Log::with('user');

        if ($userId) {
            $query->where('user_id', $userId);
        }

        if ($action) {
            $query->where('action', $action);
        }

        $logs = $query->orderBy('log_date', 'desc')->paginate(50);

        return view('logs.index', compact('logs'));
    }

    /**
     * Export logs to CSV
     */
    public function export(Request $request)
    {
        if (Auth::user()?->role !== 'OWNER') {
            abort(403, 'Unauthorized');
        }

        $logs = Log::with('user')->orderBy('log_date', 'desc')->get();

        $filename = 'activity-logs-' . now()->format('Y-m-d-H-i-s') . '.csv';
        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Add CSV header
        fputcsv($handle, ['Date', 'User', 'Email', 'Action', 'Details']);

        // Add data rows
        foreach ($logs as $log) {
            $details = json_decode($log->details, true);
            $detailsStr = '';
            
            if ($details) {
                if (isset($details['ip_address'])) {
                    $detailsStr .= 'IP: ' . $details['ip_address'];
                }
                if (isset($details['session_duration'])) {
                    $detailsStr .= ' | Duration: ' . $details['session_duration'] . 's';
                }
            }

            fputcsv($handle, [
                $log->log_date->format('Y-m-d H:i:s'),
                $log->user->name ?? 'Unknown',
                $log->user->email ?? 'N/A',
                $log->action,
                $detailsStr,
            ]);
        }

        fclose($handle);
        exit;
    }
}
