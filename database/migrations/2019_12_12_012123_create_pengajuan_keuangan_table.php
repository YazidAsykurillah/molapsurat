<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuanKeuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_keuangan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_surat_tugas_id');
            $table->string('nama_kegiatan');
            $table->date('tanggal_mulai_kegiatan');
            $table->date('tanggal_selesai_kegiatan');
            $table->integer('pic_id')->comment('Penanggung Jawab Diambil dari table user.id');
            $table->decimal('jumlah_pengajuan', 20, 2);
            $table->integer('pagu_tahunan_id')->comment('Pagu tahunan diambil berdasarkan tanggal mulai surat tugas terpilih');
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
        Schema::dropIfExists('pengajuan_keuangan');
    }
}
