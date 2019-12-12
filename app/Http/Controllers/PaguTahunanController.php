<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePaguTahunanRequest;

use DataTables;

use App\PaguTahunan;

class PaguTahunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pagu-tahunan.index');
    }

    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $pagu_tahunan = PaguTahunan::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'pagu_tahunan.*'
        ]);

        return DataTables::eloquent($pagu_tahunan)
            ->addColumn('rownum', function($pagu_tahunan){
                return $pagu_tahunan->rownum;
            })
            ->addColumn('kasubag', function($pagu_tahunan){
                return 'Keuangan';
            })
            ->editColumn('jumlah_anggaran', function($pagu_tahunan){
                return number_format($pagu_tahunan->jumlah_anggaran, 2);
            })
            ->editColumn('balance', function($pagu_tahunan){
                return number_format($pagu_tahunan->balance, 2);
            })
            ->addColumn('action', function($pagu_tahunan){
                $action = '';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$pagu_tahunan->id.'" data-text="'.$pagu_tahunan->year.'" title="Hapus">';
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
        $year_options = [];
        for ($i=2018; $i <= 2025; $i++) { 
            $year_options[] = $i;
        }

        return view('pagu-tahunan.create')
            ->with('year_options', $year_options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaguTahunanRequest $request)
    {
        $pagu_tahunan = new PaguTahunan;
        $pagu_tahunan->tahun = $request->tahun;
        $pagu_tahunan->jumlah_anggaran = floatval(preg_replace('#[^0-9.]#', '', $request->jumlah_anggaran));
        $pagu_tahunan->balance = floatval(preg_replace('#[^0-9.]#', '', $request->jumlah_anggaran));
        $pagu_tahunan->save();
        return redirect('pagu-tahunan')
            ->with('successMessage', "Berhasil menginput pagu tahunan");
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
