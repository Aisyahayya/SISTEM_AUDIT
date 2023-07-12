<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitAudit extends Model
{
    use HasFactory;
    protected $table = 'unit_audits';
    public function periodeAudit()
    {
        return $this->belongsTo(PeriodeAudit::class, 'id_periode_audit');
    }
    public function standarRuangLingkup()
    {
        return $this->hasMany(StandarRuangLingkup::class, 'id_unit_audit');
    }
    protected $fillable = [
        'id_periode_audit',
        // 'id_standar_ruang_lingkup',
        'nama_unit',
        'tanggal_audit',
        'ketua_tim',
        'nip_ketua_tim',
        'id_auditor'
    ];
}
