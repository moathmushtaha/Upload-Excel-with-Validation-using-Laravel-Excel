<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'ip_address',
        'hostname',
        'port',
        'port_protocol',
        'cvss',
        'severity',
        'nvt_name',
        'summary',
        'cves',
        'solution',
        'remarks',
        'status',
        'date_discovered',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
