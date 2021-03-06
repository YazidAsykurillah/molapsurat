<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use DataTables;
//User Maatwebsite Excel package
use Excel;
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
                return $user->rownum;
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
        $user = User::findOrFail($id);
        return view('user.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit')
            ->with('roles', $roles)
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        //attach role_user table
        \DB::table('role_user')->where('user_id', $user->id)->delete();
        $data_role_user = ['role_id'=>$request->role_id, 'user_id'=>$user->id];
        \DB::table('role_user')->insert($data_role_user);
        return redirect('user/'.$user->id)
            ->with('successMessage', "Pengguna telah diupdate");
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

    public function select2(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = User::where('name', 'LIKE', "%$search%")
                    ->get();
        }
        else{
            $data = User::get();
        }
        return response()->json($data);
    }

    public function import(Request $request)
    {
        // return $request->all();
        if($request->hasFile('file')){
            config(['excel.import.startRow' => 10]);
            $path = $request->file('file')->getRealPath();
            $data = Excel::selectSheetsByIndex(0)->load($path, function($reader) {
                $reader->noHeading = true;
                $reader->ignoreEmpty();
            })->get();
            $to_insert = [];
            foreach ($data as $key => $value) {
                if($value[0]!=''){
                    // $to_insert[] = ['name'=>$value[1], 'username'=>$value[2]];    
                    array_push($to_insert,
                        [
                            'name'=>$value[1],
                            'username'=>preg_replace('#[^0-9]#', '', $value[2]),
                            'email'=>preg_replace('#[^0-9]#', '', $value[2])."@molasurat.localhost",
                        ]
                    );
                }
                    
            }
            /*echo '<pre>';
            print_r($to_insert);
            echo '</pre>';
            exit();*/
            foreach($to_insert as $res){
               $user = User::updateOrCreate(
                    ['username'=>$res['username']],
                    [
                        'name'=>$res['name'],
                        'username'=>$res['username'],
                        'email'=>$res['email'],
                        'password'=>bcrypt('12345')
                    ]
               );
            }
        }
        else{
            return redirect()->back()
            ->with('errorMessage', "No file to be imported");
        }
    }


    public function renderImportView()
    {
        $roles = Role::all();
        return view('user.import')
            ->with('roles', $roles);
    }
}
