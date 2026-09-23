<?php

use App\Models\Monitor;
use App\Jobs\CheckMonitorJob;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $monitors = Monitor::where('status', '!=', 'paused')->get();

    foreach ($monitors as $monitor) {
        CheckMonitorJob::dispatch($monitor);
    }
})->everyMinute();