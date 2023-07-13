<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $table = 'evaluasi';

    protected $fillable = [
        'standar_ruang_lingkup_id',
        'kondisi_awal',
        'dasar_evaluasi',
        'penyebab',
        'akibat',
        'rekomendasi_followup',
    ];

    public function standarRuangLingkup()
    {
        return $this->belongsTo(StandarRuangLingkup::class, 'standar_ruang_lingkup_id');
    }
}
