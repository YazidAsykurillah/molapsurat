<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use Carbon\Carbon;

use App\RealisasiKeuangan;

class RealisasiKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('realisasi-keuangan.index');
    }

    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $data = RealisasiKeuangan::with(['pengajuan_keuangan', 'pengajuan_keuangan.jenis_surat_tugas'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'realisasi_keuangan.*'
        ]);

        return DataTables::eloquent($data)
            ->addColumn('rownum', function($data){
                return $data->rownum;
            })
            ->addColumn('judul_jenis_surat_tugas', function($data){
                return $data->pengajuan_keuangan->jenis_surat_tugas->judul;
            })
            ->addColumn('jumlah_pengajuan', function($data){
                return number_format($data->pengajuan_keuangan->jumlah_pengajuan, 2);
            })
            ->editColumn('jumlah_realisasi', function($data){
                return number_format($data->jumlah_realisasi, 2);
            })
            ->addColumn('balance', function($data){
                $balance = $data->pengajuan_keuangan->jumlah_pengajuan - $data->jumlah_realisasi;
                return number_format($balance, 2);
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $realisasi_keuangan = new RealisasiKeuangan;
        $realisasi_keuangan->pengajuan_keuangan_id = $request->pengajuan_keuangan_id;
        $realisasi_keuangan->jumlah_realisasi = floatval(preg_replace('#[^0-9.]#', '', $request->jumlah_realisasi));
        $realisasi_keuangan->save();
        return redirect()
            ->back()
            ->with('successMessage', "Berhasil input realisasi keuangan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
