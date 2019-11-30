<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreJenisSuratTugasRequest;
use App\Http\Requests\UpdateJenisSuratTugasRequest;

use DataTables;

use App\JenisSuratTugas;

class JenisSuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jenis-surat-tugas.index');
    }

    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $jenis_surat_tugas = JenisSuratTugas::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'jenis_surat_tugas.*'
        ]);

        return DataTables::eloquent($jenis_surat_tugas)
            ->addColumn('rownum', function($jenis_surat_tugas){
                return '#';
            })
            ->addColumn('action', function($jenis_surat_tugas){
                $action = '';
                $action.= '<a href="'.url('jenis-surat-tugas/'.$jenis_surat_tugas->id.'/edit').'" class="btn btn-secondary btn-xs" title="Edit">';
                $action.=   '<i class="fa fa-edit"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$jenis_surat_tugas->id.'" data-judul="'.$jenis_surat_tugas->judul.'" title="Hapus">';
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
        return view('jenis-surat-tugas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJenisSuratTugasRequest $request)
    {
        $jenis_surat_tugas = new JenisSuratTugas;
        $jenis_surat_tugas->judul = $request->judul;
        $jenis_surat_tugas->deskripsi = $request->deskripsi;
        $jenis_surat_tugas->save();
        return redirect('jenis-surat-tugas/'.$jenis_surat_tugas->id)
            ->with('successMessage', "Jenis Surat Tugas tersimpan");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jenis_surat_tugas = JenisSuratTugas::findOrFail($id);
        return view('jenis-surat-tugas.show')
            ->with('jenis_surat_tugas', $jenis_surat_tugas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis_surat_tugas = JenisSuratTugas::findOrFail($id);
        return view('jenis-surat-tugas.edit')
            ->with('jenis_surat_tugas', $jenis_surat_tugas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJenisSuratTugasRequest $request, $id)
    {
        $jenis_surat_tugas = JenisSuratTugas::findOrFail($id);
        $jenis_surat_tugas->judul = $request->judul;
        $jenis_surat_tugas->deskripsi = $request->deskripsi;
        $jenis_surat_tugas->save();
        return redirect('jenis-surat-tugas/'.$jenis_surat_tugas->id)
            ->with('successMessage', 'Jenis surat tugas berhasil diperbarui');
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
        $jenis_surat_tugas = JenisSuratTugas::findOrFail($request->id_to_delete);
        //jenis surat tugas is deletable if only has not related surat tugas
        if($jenis_surat_tugas->surat_tugas->count()){
            return redirect()->back()
                ->with('errorMessage', "Gagal hapus $jenis_surat_tugas->judul :: terdapat surat tugas yang berelasi");
        }else{
            $jenis_surat_tugas->delete();
            return redirect()->back()
                ->with('successMessage', "Jenis surat tugas $jenis_surat_tugas->judul dihapus");
        }
    }

    public function select2(Request $request)
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
