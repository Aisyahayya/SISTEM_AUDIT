<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandarRuangLingkup extends Model
{
    use HasFactory;
    protected $table = 'standar_ruang_lingkups';

    protected $fillable = [
        'unit',
        'id_auditee',
        'ruang_lingkup',
        'parameter_ruang_lingkup',
        'status',
        'feedback',
        'file_auditee'
    ];

    protected $hidden = [
        'id',
    ];
}