<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuratTugas;
use App\LaporanSuratTugas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $surat_tugas_count = SuratTugas::get()->count();
        $laporan_surat_tugas_count = LaporanSuratTugas::get()->count();
        $laporan_surat_tugas_belum_selesai_count = LaporanSuratTugas::where('status','!=', '4')->get()->count();
        $laporan_surat_tugas_selesai_count = LaporanSuratTugas::where('status','=', '4')->get()->count();


        return view('home')
            ->with('surat_tugas_count', $surat_tugas_count)
            ->with('laporan_surat_tugas_count', $laporan_surat_tugas_count)
            ->with('laporan_surat_tugas_belum_selesai_count', $laporan_surat_tugas_belum_selesai_count)
            ->with('laporan_surat_tugas_selesai_count', $laporan_surat_tugas_selesai_count);
    }


    public function getChartDataAnggaran(Request $request)
    {
        $response = [];
        $response['labels'] = ['Pagu Anggaran', 'Realisasi'];
        $response['data'] = [100000000, 97500000];
        $response['backgroundColor'] = ['rgb(255, 99, 132)', 'rgb(100, 99, 132)'];
        return $response;
    }
}
