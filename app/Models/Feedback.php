<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = ['komentar', 'tindak_lanjut', 'tanggal_kesanggupan', 'standar_ruang_lingkup_id'];

    public function standarRuangLingkup()
    {
        return $this->belongsTo(StandarRuangLingkup::class);
    }
}
