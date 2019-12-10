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
        return view('home')
            ->with('surat_tugas_count', $surat_tugas_count)
            ->with('laporan_surat_tugas_count', $laporan_surat_tugas_count);
    }
}
