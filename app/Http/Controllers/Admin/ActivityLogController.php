<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::query()
            ->with('user');

        if ($request->filled('module')) {
            $query->where(
                'module',
                $request->input('module')
            );
        }

        if ($request->filled('action')) {
            $query->where(
                'action',
                'like',
                '%' . $request->input('action') . '%'
            );
        }

        if ($request->filled('date')) {
            $query->whereDate(
                'created_at',
                $request->input('date')
            );
        }

        if ($request->filled('search')) {
            $search = trim(
                $request->input('search')
            );

            $query->where(function ($q) use ($search) {
                $q->where(
                    'ip_address',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'action',
                    'like',
                    "%{$search}%"
                );
            });
        }

        $logs = $query
            ->latest()
            ->paginate(30)
            ->withQueryString();

        return view(
            'admin.activity-logs.index',
            compact('logs')
        );
    }

    public function show(ActivityLog $activityLog)
    {
        $activityLog->load('user');

        return view(
            'admin.activity-logs.show',
            compact('activityLog')
        );
    }
}