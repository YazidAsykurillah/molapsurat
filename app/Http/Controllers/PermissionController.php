<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Permission;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permission.index');
    }

     public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $permissions = Permission::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'permissions.*'
        ]);

        return DataTables::eloquent($permissions)
            ->addColumn('rownum', function($permissions){
                return '#';
            })
            ->addColumn('action', function($permissions){
                $action = '';
                $action.= '<a href="'.url('permission/'.$permissions->id.'/edit').'" class="btn btn-secondary btn-xs" title="Edit">';
                $action.=   '<i class="fa fa-edit"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$permissions->id.'" data-slug="'.$permissions->slug.'" title="Hapus">';
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
        //
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
