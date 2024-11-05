<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceTokens extends Model
{
    use HasFactory;

    protected $table = 'attendance_tokens';

    protected $fillable = [
        'tanggal',
        'token',
        'is_active',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
