<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mappingunitaudit extends Model
{
    use HasFactory;

    protected $table = 'mapping_unit_auditor';

    protected $fillable = [
        'id',
        // 'id_standar_ruang_lingkup',
        'id_auditor',
        'id_unit',
        // 'ketua_tim',
        // 'nip_ketua_tim',
        // 'id_auditor'
    ];
}
