<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusAndNomorRoutingSlipToTableLaporanSuratTugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan_surat_tugas', function(Blueprint $table){
            $table->enum('status', ['1', '2', '3', '4'])->nullable()->default(NULL)->after('attachment');
            $table->text('nomor_routing_slip')->nullable()->default(NULL)->after('status');
            $table->text('attachment_routing_slip')->nullable()->default(NULL)->after('nomor_routing_slip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_surat_tugas', function(Blueprint $table){
            $table->dropColumn('status');
            $table->dropColumn('nomor_routing_slip');
            $table->dropColumn('attachment_routing_slip');
        });
    }
}
