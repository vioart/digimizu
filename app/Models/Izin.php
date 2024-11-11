<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'user_id',
        'tanggal',
        'waktu',
        'foto',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}