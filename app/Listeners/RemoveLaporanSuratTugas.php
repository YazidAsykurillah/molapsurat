<?php

namespace App\Listeners;

use App\Events\SuratTugasIsDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveLaporanSuratTugas
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
     * @param  SuratTugasIsDeleted  $event
     * @return void
     */
    public function handle(SuratTugasIsDeleted $event)
    {
        $surat_tugas = $event->surat_tugas;
        $surat_tugas_id = $surat_tugas->id;
        \DB::table('laporan_surat_tugas')->where('surat_tugas_id', '=', $surat_tugas_id)->delete();
    }
}
