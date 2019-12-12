<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSuratTugasRequest;
use DataTables;
use Carbon\Carbon;
use App\SuratTugas;

use Event;
use App\Events\SuratTugasIsDeleted;

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
                return $surat_tugas->rownum;
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
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$surat_tugas->id.'" data-nomor="'.$surat_tugas->nomor.'" title="Hapus">';
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
    {   $user_options = \App\User::all();
        $position_options = config('surat_tugas.position_options');
        return view('surat-tugas.create')
            ->with('position_options', $position_options);
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

        //store to surat_tugas_user table
        $data_team = [];
        foreach($request->user_id as $key=>$val){
            $data_team[] = [
                'surat_tugas_id'=>$surat_tugas->id,
                'user_id'=>$request->user_id[$key],
                'position'=>$request->position[$key],
            ];
        }
        \DB::table('surat_tugas_user')->insert($data_team);

        return redirect('surat-tugas/'.$surat_tugas->id)
            ->with('successMessage', "Berhasil membuat surat tugas");
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

    public function delete(Request $request)
    {   
        $attachment_to_delete = NULL;
        $surat_tugas = SuratTugas::findOrFail($request->id_to_delete);
        $attachment_to_delete = $surat_tugas->attachment != NULL ? $attachment_to_delete ='files/surat-tugas/'.$surat_tugas->attachment : $attachment_to_delete = NULL;
        if($surat_tugas->delete()){
            if($attachment_to_delete != NULL){
                if(file_exists($attachment_to_delete)){
                    unlink($attachment_to_delete);
                }
                
            }
            //Fire event Surat Tugas is deleted
            Event::fire(new SuratTugasIsDeleted($surat_tugas));
            
            return redirect('surat-tugas')
                ->with('successMessage', "Surat tugas dihapus");
        }

    }

    public function monitoring()
    {
        return view('surat-tugas.monitoring');
    }

    public function MonitoringDatatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $surat_tugas = SuratTugas::with(['jenis_surat_tugas', 'tujuan_surat_tugas', 'laporan_surat_tugas'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'surat_tugas.*'
        ]);

        return DataTables::eloquent($surat_tugas)
            ->addColumn('rownum', function($surat_tugas){
                return $surat_tugas->rownum;
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
            ->addColumn('laporan_surat_tugas_id', function($surat_tugas){
                $display = '';
                if($surat_tugas->laporan_surat_tugas){
                    $display = 'exists';
                }else{
                    $display='-';
                }
                return $display;
            })
            ->addColumn('status_laporan_surat_tugas', function($surat_tugas){
                $display = '-';
                if($surat_tugas->laporan_surat_tugas){
                    $display = status_laporan_surat_tugas($surat_tugas->laporan_surat_tugas->status);
                }
                return $display;
            })
            ->addColumn('color', function($surat_tugas){
                $color = '';
                $color = 'red';
                return $color;
            })
            ->make(true);
    }
}
