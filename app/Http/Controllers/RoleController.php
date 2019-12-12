<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use DataTables;

use App\Role;
use App\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.index');
    }

    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $roles = Role::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'roles.*'
        ])->where('code','!=', 'SUP');

        return DataTables::eloquent($roles)
            ->addColumn('rownum', function($roles){
                return $roles->rownum;
            })
            ->addColumn('action', function($roles){
                $action = '';
                $action.= '<a href="'.url('role/'.$roles->id.'/edit').'" class="btn btn-secondary btn-xs" title="Edit">';
                $action.=   '<i class="fa fa-edit"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$roles->id.'" data-code="'.$roles->code.'" title="Hapus">';
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
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = new Role;
        $role->code = $request->code;
        $role->name = $request->name;
        $role->label = $request->label;
        $role->save();
        return redirect('role/'.$role->id)
            ->with('successMessage', "Role tersimpan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('role.show')
            ->with('role', $role)
            ->with('permissions', $permissions);
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

    public function updateRolePermission(Request $request)
    {
        $role_id = $request->role_id;
        $role = Role::find($role_id);
        $role->permissions()->detach();
        $role->permissions()->attach($request->permission_id);
        return redirect('role/'.$role_id);
    }
}
