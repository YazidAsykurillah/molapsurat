<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSuratTugasRequest;
use Carbon\Carbon;
use App\SuratTugas;
use DataTables;

class SuratTugasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat-tugas.index');
    }

    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $surat_tugas = SuratTugas::with(['jenis_surat_tugas', 'tujuan_surat_tugas'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'surat_tugas.*'
        ]);

        return DataTables::eloquent($surat_tugas)
            ->addColumn('rownum', function($surat_tugas){
                return '#';
            })
            ->addColumn('judul_jenis_surat_tugas', function($surat_tugas){
                return $surat_tugas->jenis_surat_tugas->judul;
            })
            ->addColumn('nama_tujuan_surat_tugas', function($surat_tugas){
                return $surat_tugas->tujuan_surat_tugas->nama;
            })
            ->editColumn('uraian', function($surat_tugas){
                return str_limit($surat_tugas->uraian, 20);
            })
            ->addColumn('action', function($surat_tugas){
                $action = '';
                $action.= '<a href="'.url('surat-tugas/'.$surat_tugas->id.'/edit').'" class="btn btn-secondary btn-xs" title="Edit">';
                $action.=   '<i class="fa fa-edit"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$surat_tugas->id.'" title="Hapus">';
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
        return view('surat-tugas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSuratTugasRequest $request)
    {
        $attachment = NULL;
        if($request->has('attachment')){
            $attachment = $this->upload_surat_tugas_attachment($request);
        }
        $surat_tugas = new SuratTugas;
        $surat_tugas->nomor = $request->nomor;
        $surat_tugas->tanggal = $request->tanggal;
        $surat_tugas->jenis_surat_tugas_id = $request->jenis_surat_tugas_id;
        $surat_tugas->tujuan_surat_tugas_id = $request->tujuan_surat_tugas_id;
        $surat_tugas->tanggal_mulai = $request->tanggal_mulai;
        $surat_tugas->tanggal_selesai = $request->tanggal_selesai;
        $surat_tugas->uraian = $request->uraian;
        $surat_tugas->attachment = $attachment;
        $surat_tugas->save();
        return redirect('surat-tugas/'.$surat_tugas->id)
            ->with('successMessage', "Berhasil");
    }

    protected function upload_surat_tugas_attachment($request)
    {
        $path = 'files/surat-tugas';
        $extension = $request->attachment->getClientOriginalExtension();
        $file_name = time().'.'.$extension;
        $request->attachment->move($path, $file_name);
        return $file_name;

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $surat_tugas = SuratTugas::findOrFail($id);
        return view('surat-tugas.show')
            ->with('surat_tugas', $surat_tugas);
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
