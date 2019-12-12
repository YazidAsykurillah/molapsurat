<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePengajuanKeuanganRequest;

use DataTables;
use Carbon\Carbon;

use App\PengajuanKeuangan;
use App\SuratTugas;
use App\PaguTahunan;

use Event;
use App\Events\PengajuanKeuanganIsCreated;


class PengajuanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengajuan-keuangan.index');
    }

    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $data = PengajuanKeuangan::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'pengajuan_keuangan.*'
        ]);

        return DataTables::eloquent($data)
            ->addColumn('rownum', function($data){
                return $data->rownum;
            })
            ->addColumn('nomor_surat_tugas', function($data){
                return $data->surat_tugas->nomor;
            })
            ->editColumn('jumlah_pengajuan', function($data){
                return number_format($data->jumlah_pengajuan, 2);
            })
            ->addColumn('action', function($data){
                $action = '';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$data->id.'" data-text="'.$data->surat_tugas->nomor.'" title="Hapus">';
                $action.=   '<i class="fa fa-trash"></i>';
                $action.= '</a>';
                return $action;
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
        return view('pengajuan-keuangan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengajuanKeuanganRequest $request)
    {
        $surat_tugas = SuratTugas::findOrFail($request->surat_tugas_id);
        //tahun surat tugas 
        $year_of_surat_tugas = Carbon::parse($surat_tugas->tanggal_mulai)->year;
        //get pagu tahunan;
        $pagu_tahunan = PaguTahunan::where('tahun', '=', $year_of_surat_tugas)->get()->first();
        if(!$pagu_tahunan){
            return redirect()
                ->back()
                ->with('errorMessage', "Belum ada pagu tahunan untuk tahun $year_of_surat_tugas");
        }

        $pengajuan_keuangan = new PengajuanKeuangan;
        $pengajuan_keuangan->surat_tugas_id = $request->surat_tugas_id;
        $pengajuan_keuangan->jumlah_pengajuan = floatval(preg_replace('#[^0-9.]#', '', $request->jumlah_pengajuan));
        $pengajuan_keuangan->pagu_tahunan_id = $pagu_tahunan->id;
        $pengajuan_keuangan->save();

        //Fire event PengajuanKeuanganIsCreated
        Event::fire(new PengajuanKeuanganIsCreated($pengajuan_keuangan));

        return redirect('pengajuan-keuangan')
            ->with('successMessage', "Berhasil input pengajuan keuangan");
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

    public function select2SuratTugas(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = SuratTugas::doesnthave('pengajuan_keuangan')->where('nomor', 'LIKE', "%$search%")
                    ->get();
        }
        else{
            $data = SuratTugas::doesnthave('pengajuan_keuangan')->with(['jenis_surat_tugas', 'tujuan_surat_tugas', 'users'])->get();
        }
        return response()->json($data);
    }
}
