<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTujuanSuratTugasRequest;
use DataTables;

use App\TujuanSuratTugas;

class TujuanSuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tujuan-surat-tugas.index');
    }

    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $tujuan_surat_tugas = TujuanSuratTugas::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'tujuan_surat_tugas.*'
        ]);

        return DataTables::eloquent($tujuan_surat_tugas)
            ->addColumn('rownum', function($tujuan_surat_tugas){
                return '#';
            })
            ->addColumn('action', function($tujuan_surat_tugas){
                $action = '';
                $action.= '<a href="'.url('tujuan-surat-tugas/'.$tujuan_surat_tugas->id.'/edit').'" class="btn btn-secondary btn-xs" title="Edit">';
                $action.=   '<i class="fa fa-edit"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$tujuan_surat_tugas->id.'" data-nama="'.$tujuan_surat_tugas->nama.'" title="Hapus">';
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
        return view('tujuan-surat-tugas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTujuanSuratTugasRequest $request)
    {
        $tujuan_surat_tugas = new TujuanSuratTugas;
        $tujuan_surat_tugas->nama = $request->nama;
        $tujuan_surat_tugas->alamat = $request->alamat;
        $tujuan_surat_tugas->save();
        return redirect('tujuan-surat-tugas/'.$tujuan_surat_tugas->id)
            ->with('successMessage', "Tujuan Surat tugas tersimpan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tujuan_surat_tugas = TujuanSuratTugas::findOrFail($id);
        return view('tujuan-surat-tugas.show')
            ->with('tujuan_surat_tugas', $tujuan_surat_tugas);
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

    public function delete(Request $request)
    {
        $tujuan_surat_tugas = TujuanSuratTugas::findOrFail($request->id_to_delete);
        //jenis surat tugas is deletable if only has not related surat tugas
        if($tujuan_surat_tugas->surat_tugas->count()){
            return redirect()->back()
                ->with('errorMessage', "Gagal hapus $tujuan_surat_tugas->nama :: terdapat surat tugas yang berelasi");
        }else{
            $tujuan_surat_tugas->delete();
            return redirect()->back()
                ->with('successMessage', "Jenis surat tugas $tujuan_surat_tugas->nama dihapus");
        }
    }

    public function select2(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = TujuanSuratTugas::where('nama', 'LIKE', "%$search%")
                    ->get();
        }
        else{
            $data = TujuanSuratTugas::get();
        }
        return response()->json($data);
    }
}
