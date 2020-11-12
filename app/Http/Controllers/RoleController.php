<?php

namespace App\Http\Controllers;
use App\Models\Role;
 use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
// use Illuminate\Support\Facades\Schema;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {

        //$roles = Role::latest()->paginate(5);
        $roles = DB::table('roles AS r')
                        ->leftJoin('users AS cr', 'r.CreatedBy', '=', 'cr.user_id')
                        ->leftJoin('users AS up', 'r.UpdatedBy', '=', 'up.user_id')
                        ->select('r.roleid','r.role_name','r.isactive',
                        'cr.username AS CreatedBy','r.created_at','up.username AS UpdatedBy','r.updated_at',
                        'r.isactive' )
                        ->paginate(5);
        return view('role.index',compact('roles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    public function create()
    {
         return view('role.create');
    }


    public function store(Request $request)
    {
        $rules = [
			'roleName' => 'required|string'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('roles.index')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
				$role = new Role;
                $role->role_name = $data['roleName'];
                //$role->isactive = '';
				$role->CreatedBy = $user->user_id;
                $role->created_at = date('Y-m-d H:i:s');
                $role->UpdatedBy = null;
				$role->updated_at = null;
				$role->remember_token = $data['_token'];
				$role->save();
                return redirect()->route('roles.index')
                                ->with('status','Role created successfully.');
			}
			catch(Exception $e){
				return redirect()->route('roles.index')->with('failed',"operation failed");
			}
        }

    }


    public function show(Role $role)
    {
        // return view('users.show',compact('user'));
    }


    public function edit(Role $role)
    {
         return view('role.edit',compact('role'));
    }


    public function update(Request $request,$roleid)
    {
        //dd($request);
        $rules = [
			'roleName' => 'required|string'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('roles.edit')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
                $role = Role::find($roleid);
				//$role = new Role;
                $role->role_name = $data['roleName'];
                //$role->isactive = '';
				$role->UpdatedBy = $user->user_id;
				$role->updated_at = date('Y-m-d H:i:s');
				$role->remember_token = $data['_token'];
                $role->save();
                $role->update($request->all());
                return redirect()->route('roles.index')
                                ->with('status','Role update successfully.');
			}
			catch(Exception $e){
				return redirect()->route('roles.edit')->with('failed',"operation failed");
			}
        }
        // $request->validate([
        //     'name' => 'required',
        //     'detail' => 'required',
        // ]);

        // $user->update($request->all());

        // return redirect()->route('users.index')
        //                 ->with('success','Product updated successfully');
    }


    public function destroy(User $user)
    {
        // $user->delete();

        // return redirect()->route('users.index')
        //                 ->with('success','Product deleted successfully');
    }
}
