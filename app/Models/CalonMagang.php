<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonMagang extends Model
{
    use HasFactory;

    protected $table = 'calon_magang';

    protected $fillable = [
        'name',
        'email',
        'password',
        'asal_instansi',
        'image',
        'test_score',
        'test_date',
    ];

    protected $casts = [
        'test_date' => 'datetime',
    ];
}