<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanSuratTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_surat_tugas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('surat_tugas_id');
            $table->date('tanggal_approve_ketua_tim')->nullable();
            $table->date('tanggal_approve_pengendali_mutu')->nullable();
            $table->date('tanggal_approve_pengendali_teknis')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('laporan_surat_tugas');
    }
}
