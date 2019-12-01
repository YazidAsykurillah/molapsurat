<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use DataTables;

use App\User;
use App\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    //return datatables object
    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $user = User::with(['roles'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'users.*'
        ]);

        return DataTables::eloquent($user)
            ->addColumn('rownum', function($user){
                return '#';
            })
            ->addColumn('roles', function (User $user) {
                return $user->roles->map(function($role) {
                    return str_limit($role->name, 30, '...');
                })->implode('<br>');
            })
            ->addColumn('action', function($user){
                $action = '';
                $action.= '<a href="'.url('user/'.$user->id.'/edit').'" class="btn btn-secondary btn-xs" title="Edit">';
                $action.=   '<i class="fa fa-edit"></i>';
                $action.= '</a> &nbsp;';
                $action.= '<a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$user->id.'" title="Hapus">';
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
        $roles = Role::all();
        return view('user.create')
            ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('12345');
        $user->save();
        
        //attach role_user table
        $data_role_user = ['role_id'=>$request->role_id, 'user_id'=>$user->id];
        \DB::table('role_user')->insert($data_role_user);
        return redirect('user')
            ->with('successMessage', "Pengguna telah tersimpan");
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
