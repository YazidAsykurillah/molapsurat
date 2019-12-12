<?php

namespace App\Listeners;

use App\Events\PengajuanKeuanganIsCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\PaguTahunan;
class SynchronizePaguTahunanBalanceFromCreatePengajuanKeuangan
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PengajuanKeuanganIsCreated  $event
     * @return void
     */
    public function handle(PengajuanKeuanganIsCreated $event)
    {
        $pengajuan_keuangan = $event->pengajuan_keuangan;
        $pagu_tahunan = PaguTahunan::findOrFail($pengajuan_keuangan->pagu_tahunan_id);
        //jumlah_anggaran
        $jumlah_anggaran = $pagu_tahunan->jumlah_anggaran;

        //sum jumlah pengajuan keuangan
        $sum_jumlah_pengajuan = \DB::table('pengajuan_keuangan')
            ->where('pagu_tahunan_id', '=', $pagu_tahunan->id)
            ->sum('jumlah_pengajuan');

        //count balance
        $balance = $jumlah_anggaran-$sum_jumlah_pengajuan;

        //Update the balance
        $pagu_tahunan->balance = $balance;
        $pagu_tahunan->save();

    }
}
