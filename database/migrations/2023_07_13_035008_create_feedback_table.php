<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->text('komentar');
            $table->text('tindak_lanjut');
            $table->date('tanggal_kesanggupan');
            // $table->unsignedBigInteger('standar_ruang_lingkup_id');
            $table->integer('standar_ruang_lingkup_id')->nullable()->unsigned();
            $table->timestamps();

            // $table->foreign('standar_ruang_lingkup_id')->references('id')->on('standar_ruang_lingkups');
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
}
