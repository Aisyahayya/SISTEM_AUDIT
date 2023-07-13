<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandarRuangLingkupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standar_ruang_lingkups', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('feedback_id');
            // $table->foreign('feedback_id')->references('id')->on('feedbacks')->onDelete('cascade');
            $table->integer('id_auditee')->nullable()->unsigned();
            $table->string('unit');
            $table->string('file_auditee');
            $table->string('ruang_lingkup');
            $table->text('parameter_ruang_lingkup');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standar_ruang_lingkups');
    }
}
