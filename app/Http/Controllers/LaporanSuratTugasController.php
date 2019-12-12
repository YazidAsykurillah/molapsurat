<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLaporanSuratTugasRequest;

use DataTables;
use Carbon\Carbon;
use App\LaporanSuratTugas;
use App\SuratTugas;

class LaporanSuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laporan-surat-tugas.index');
    }

    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $data = LaporanSuratTugas::with(
            ['surat_tugas', 'surat_tugas.jenis_surat_tugas','surat_tugas.tujuan_surat_tugas']
        )->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'laporan_surat_tugas.*'
        ]);

        return DataTables::eloquent($data)
            ->addColumn('rownum', function($data){
                return $data->rownum;
            })
            ->addColumn('nomor_surat_tugas', function($data){
                return $data->surat_tugas->nomor;
            })
            ->editColumn('status', function($data){
                return status_laporan_surat_tugas($data->status);
            })
            ->addColumn('action', function($data){
                $action = '';
                $action.= '<a href="'.url('laporan-surat-tugas/'.$data->id.'').'" class="btn btn-info btn-xs btn-detail" data-id="'.$data->id.'" title="View">';
                $action.=   '<i class="fa fa-book-open"></i>';
                $action.= '</a>&nbsp;';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$data->id.'" data-nomor="'.$data->surat_tugas->nomor.'" title="Hapus">';
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
        return view('laporan-surat-tugas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaporanSuratTugasRequest $request)
    {
        $attachment = NULL;
        if($request->has('attachment')){
            $attachment = $this->upload_attachment($request);
        }
        $surat_tugas = new LaporanSuratTugas;
        $surat_tugas->surat_tugas_id = $request->surat_tugas_id;
        $surat_tugas->tanggal_approve_ketua_tim = $request->tanggal_approve_ketua_tim;
        $surat_tugas->tanggal_approve_pengendali_mutu = $request->tanggal_approve_pengendali_mutu;
        $surat_tugas->tanggal_approve_pengendali_teknis = $request->tanggal_approve_pengendali_teknis;
        $surat_tugas->attachment = $attachment;
        $surat_tugas->save();

        return redirect('laporan-surat-tugas/'.$surat_tugas->id)
            ->with('successMessage', "Berhasil membuat laporan surat tugas");
    }

    protected function upload_attachment($request)
    {
        $path = 'files/laporan-surat-tugas';
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
        $laporan_surat_tugas = LaporanSuratTugas::findOrFail($id);
        $surat_tugas = $laporan_surat_tugas->surat_tugas;
        return view('laporan-surat-tugas.show')
            ->with('laporan_surat_tugas', $laporan_surat_tugas)
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

    public function select2SuratTugas(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = SuratTugas::doesnthave('laporan_surat_tugas')->where('nomor', 'LIKE', "%$search%")
                    ->get();
        }
        else{
            $data = SuratTugas::doesnthave('laporan_surat_tugas')->with(['jenis_surat_tugas', 'tujuan_surat_tugas', 'users'])->get();
        }
        return response()->json($data);
    }


    public function approveByKasubagTU(Request $request, $id)
    {
        $laporan_surat_tugas = LaporanSuratTugas::findOrFail($id);
        $laporan_surat_tugas->status = '1';
        $laporan_surat_tugas->save();
        return redirect()->back()
            ->with('successMessage', "Status berhasil dirubah");
    }

    public function approveByInspektur(Request $request, $id){
        $laporan_surat_tugas = LaporanSuratTugas::findOrFail($id);
        $laporan_surat_tugas->status = '2';
        $laporan_surat_tugas->nomor_routing_slip = $request->nomor_routing_slip;
        $laporan_surat_tugas->save();
        return redirect()->back()
            ->with('successMessage', "Status berhasil dirubah");
    }

    public function approveByTUSes(Request $request, $id)
    {
        $laporan_surat_tugas = LaporanSuratTugas::findOrFail($id);
        $laporan_surat_tugas->status = '3';
        $laporan_surat_tugas->save();
        return redirect()->back()
            ->with('successMessage', "Status berhasil dirubah");
    }

    public function complete(Request $request, $id)
    {
        $laporan_surat_tugas = LaporanSuratTugas::findOrFail($id);
        $laporan_surat_tugas->status = '4';
        $laporan_surat_tugas->save();
        return redirect()->back()
            ->with('successMessage', "Status berhasil dirubah");
    }

    public function delete(Request $request)
    {
        $attachment_to_delete = NULL;
        $laporan_surat_tugas = LaporanSuratTugas::findOrFail($request->id_to_delete);
        $attachment_to_delete = $laporan_surat_tugas->attachment != NULL ? $attachment_to_delete ='files/laporan-surat-tugas/'.$laporan_surat_tugas->attachment : $attachment_to_delete = NULL;
        if($laporan_surat_tugas->delete()){
            if($attachment_to_delete != NULL){
                if(file_exists($attachment_to_delete)){
                    unlink($attachment_to_delete);
                }
                
            }
            
            return redirect('laporan-surat-tugas')
                ->with('successMessage', "Laporan Surat tugas dihapus");
        }

    }
}
