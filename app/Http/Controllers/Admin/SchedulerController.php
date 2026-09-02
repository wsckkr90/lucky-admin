<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class SchedulerController extends Controller
{
    public function index()
    {
        return view('admin.scheduler.index', [
            'timezone' => config('app.timezone'),
        ]);
    }

    public function run()
    {
        Artisan::call('schedule:run');

        return redirect()
            ->route('admin.scheduler.index')
            ->with(
                'success',
                'Scheduler checked successfully.'
            );
    }
}
