<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'url_or_ip',
        'type',
        'check_interval',
        'timeout',
        'status',
        'last_response_time',
        'last_checked_at',
    ];

    protected $casts = [
        'last_checked_at' => 'datetime',
    ];

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function logs()
    {
        return $this->hasMany(MonitorLog::class);
    }
}