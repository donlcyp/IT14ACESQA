<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of activity logs.
     */
    public function index(Request $request)
    {
        $query = Log::with('user');

        // Filter by action
        if ($request->has('action') && $request->action) {
            $query->where('action', $request->action);
        }

        // Filter by user
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range
        if ($request->has('from_date') && $request->from_date) {
            $query->whereDate('log_date', '>=', $request->from_date);
        }

        if ($request->has('to_date') && $request->to_date) {
            $query->whereDate('log_date', '<=', $request->to_date);
        }

        // Get available actions for filter
        $actions = Log::distinct()->pluck('action')->sort();

        // Get logs with pagination
        $logs = $query->orderBy('log_date', 'desc')->paginate(50);

        return view('activity-log', compact('logs', 'actions'));
    }

    /**
     * Show detailed information about a log entry.
     */
    public function show(Log $log)
    {
        $log->load('user');
        return view('activity-log-detail', compact('log'));
    }
}
