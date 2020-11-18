<?php

namespace App\Http\Controllers;
use App\Models\Role;
 use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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

        $roles = DB::table('roles AS r')
                        ->leftJoin('users AS cr', 'r.CreatedBy', '=', 'cr.user_id')
                        ->leftJoin('users AS up', 'r.UpdatedBy', '=', 'up.user_id')
                        ->select('r.roleid','r.role_name','r.isactive',
                        'cr.username AS CreatedBy','r.created_at','up.username AS UpdatedBy','r.updated_at'
                         )
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
        //dd($request);
        $rules = [
			'role_name' => 'required|unique:roles|string|max:50'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('roles.index')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
				$role = new Role;
                $role->role_name = $data['role_name'];
                //$role->isactive = '';
				$role->CreatedBy = $user->user_id;
                $role->created_at = Carbon::now();
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
			'roleName' => 'required|string|max:50'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('roles.edit',$roleid)->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
                $role = Role::find($roleid);
				//$role = new Role;
                $role->role_name = $data['roleName'];
                //$role->isactive = '';
				$role->UpdatedBy = $user->user_id;
				$role->updated_at = Carbon::now();
				$role->remember_token = $data['_token'];
                $role->save();
                $role->update($request->all());
                return redirect()->route('roles.index')
                                ->with('status','Role update successfully.');
			}
			catch(Exception $e){
				return redirect()->route('roles.edit',$roleid)->with('failed',"operation failed");
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
    public function status($roleid)
    {
        dd($roleid);
        $role = Role::find($roleid);
    }
}
