<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePengajuanKeuanganRequest;
use App\Http\Requests\UpdatePengajuanKeuanganRequest;

use DataTables;
use Carbon\Carbon;

use App\PengajuanKeuangan;
use App\JenisSuratTugas;
use App\PaguTahunan;

use Event;
use App\Events\PengajuanKeuanganIsCreated;
use App\Events\PengajuanKeuanganIsUpdated;


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
        $data = PengajuanKeuangan::with(['jenis_surat_tugas', 'pic'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'pengajuan_keuangan.*'
        ]);

        return DataTables::eloquent($data)
            ->addColumn('rownum', function($data){
                return $data->rownum;
            })
            ->addColumn('judul_jenis_surat_tugas', function($data){
                return $data->jenis_surat_tugas->judul;
            })
            ->addColumn('nama_penanggung_jawab', function($data){
                return $data->pic->name;
            })
            ->editColumn('jumlah_pengajuan', function($data){
                return number_format($data->jumlah_pengajuan, 2);
            })
            ->addColumn('action', function($data){
                $action = '';

                $action.= '<a href="'.url('pengajuan-keuangan/'.$data->id.'').'" class="btn btn-primary btn-xs" title="Show">';
                $action.=   '<i class="fa fa-eye"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="'.url('pengajuan-keuangan/'.$data->id.'/edit').'" class="btn btn-secondary btn-xs" title="Edit">';
                $action.=   '<i class="fa fa-edit"></i>';
                $action.= '</a> &nbsp;';
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
        $now = Carbon::now();
        $current_year = $now->format('Y');
        $pagu_tahunan = PaguTahunan::where('tahun', '=', $current_year)->get()->first();
        if(!$pagu_tahunan){
            return redirect()
                ->back()
                ->with('errorMessage', "Belum ada pagu tahunan untuk tahun $year_of_surat_tugas");
        }

        $pengajuan_keuangan = new PengajuanKeuangan;
        $pengajuan_keuangan->jenis_surat_tugas_id = $request->jenis_surat_tugas_id;
        $pengajuan_keuangan->nama_kegiatan = $request->nama_kegiatan;
        $pengajuan_keuangan->tanggal_mulai_kegiatan = $request->tanggal_mulai_kegiatan;
        $pengajuan_keuangan->tanggal_selesai_kegiatan = $request->tanggal_selesai_kegiatan;
        $pengajuan_keuangan->pic_id = $request->pic_id;
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
        $pengajuan_keuangan = PengajuanKeuangan::findOrFail($id);
        return view('pengajuan-keuangan.show')
            ->with('pengajuan_keuangan', $pengajuan_keuangan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengajuan_keuangan = PengajuanKeuangan::findOrFail($id);
        return view('pengajuan-keuangan.edit')
            ->with('pengajuan_keuangan', $pengajuan_keuangan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengajuanKeuanganRequest $request, $id)
    {
        $now = Carbon::now();
        $current_year = $now->format('Y');
        $pagu_tahunan = PaguTahunan::where('tahun', '=', $current_year)->get()->first();
        if(!$pagu_tahunan){
            return redirect()
                ->back()
                ->with('errorMessage', "Belum ada pagu tahunan untuk tahun $year_of_surat_tugas");
        }

        $pengajuan_keuangan = PengajuanKeuangan::findOrFail($id);
        $pengajuan_keuangan->jenis_surat_tugas_id = $request->jenis_surat_tugas_id;
        $pengajuan_keuangan->nama_kegiatan = $request->nama_kegiatan;
        $pengajuan_keuangan->tanggal_mulai_kegiatan = $request->tanggal_mulai_kegiatan;
        $pengajuan_keuangan->tanggal_selesai_kegiatan = $request->tanggal_selesai_kegiatan;
        $pengajuan_keuangan->pic_id = $request->pic_id;
        $pengajuan_keuangan->jumlah_pengajuan = floatval(preg_replace('#[^0-9.]#', '', $request->jumlah_pengajuan));
        $pengajuan_keuangan->pagu_tahunan_id = $pagu_tahunan->id;
        $pengajuan_keuangan->save();

        //Fire event PengajuanKeuanganIsUpdated
        Event::fire(new PengajuanKeuanganIsUpdated($pengajuan_keuangan));

        return redirect('pengajuan-keuangan')
            ->with('successMessage', "Berhasil update pengajuan keuangan");
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

    public function select2JenisSuratTugas(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = JenisSuratTugas::where('judul', 'LIKE', "%$search%")
                    ->get();
        }
        else{
            $data = JenisSuratTugas::get();
        }
        return response()->json($data);
    }
}
