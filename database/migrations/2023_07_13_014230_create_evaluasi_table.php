<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasiTable extends Migration
{
    public function up()
    {
        Schema::create('evaluasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('standar_ruang_lingkup_id');
            $table->foreign('standar_ruang_lingkup_id')->references('id')->on('standar_ruang_lingkups')->onDelete('cascade');
            $table->text('kondisi_awal');
            $table->text('dasar_evaluasi');
            $table->text('penyebab');
            $table->text('akibat');
            $table->text('rekomendasi_followup');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluasi');
    }
}
