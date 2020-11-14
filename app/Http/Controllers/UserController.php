<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Models\Exhouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {

        $roles = Role::select('roleid', 'role_name')->where('isactive','1')->orderBy('roleid')->get();
        $exHouse = Exhouse::select('ExHouseID','ExHouseName')->where('isactive','1')->orderBy('ExHouseID')->get();
        //dd($exHouse);
        $users = DB::table('users AS u')
                    ->leftJoin('users AS cr', 'u.CreatedBy', '=', 'cr.user_id')
                    ->leftJoin('users AS up', 'u.UpdatedBy', '=', 'up.user_id')
                    ->leftJoin('exhouse AS ex', 'u.ExHouseID', '=', 'ex.ExHouseID')
                    ->leftJoin('roles AS r', 'u.roleid', '=', 'r.roleid')
                    ->select('u.user_id','u.name','u.email','u.username','ex.ExHouseName','r.role_name',
                    'cr.username AS CreatedBy','u.created_at','up.username AS UpdatedBy','u.updated_at',
                    'u.isactive')
                    ->paginate(5);
        //dd($users);
        return view('users.index',compact('users','roles','exHouse'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        //$roles = DB::table('roles')->select('roleid', 'role_name')->orderBy('roleid')->get();
        // $roles = Role::select('roleid', 'role_name')->where('isactive','1')->orderBy('roleid')->get();
        // return view('users.create',compact('roles'));
    }


    public function store(Request $request)
    {
        //dd($request);
        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'exHouse' => 'required|string|max:11',
            'role' => 'required|integer',
            'username' => 'required|string|max:20',
            'password' => 'required|min:6|string|confirmed', //regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|
            'password_confirmation' => 'required|same:password',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('users.index')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $authUser = Auth::user();
				$user = new User;
                $user->name = !empty($data['name']) ? $data['name'] : '' ;
                $user->email = !empty($data['email']) ? $data['email'] : '' ;
                $user->username = !empty($data['username']) ? $data['username'] : '';
                $user->password = Hash::make(!empty($data['password']) ? $data['password'] : '');
                $user->ExHouseID = !empty($data['exHouse']) ? $data['exHouse'] : '';
                $user->roleid = !empty($data['role']) ? $data['role'] : '';
                //$user->isactive = '';
				$user->CreatedBy = $authUser->user_id;
                $user->created_at = Carbon::now();
                $user->UpdatedBy = null;
				$user->updated_at = null;
				$user->remember_token = $data['_token'];
				$user->save();
                return redirect()->route('users.index')
                                ->with('status','User created successfully.');
			}
			catch(Exception $e){
				return redirect()->route('users.index')->with('failed',"operation failed");
			}
        }

    }


    public function show(User $user)
    {
        //return view('users.show',compact('user'));
    }


    public function edit(User $user)
    {
        $roles = Role::select('roleid', 'role_name')->where('isactive','1')->orderBy('roleid')->get();
        $exHouse = Exhouse::select('ExHouseID','ExHouseName')->where('isactive','1')->orderBy('ExHouseID')->get();

        return view('users.edit',compact('user','exHouse','roles'));
    }


    public function update(Request $request, $user_id)
    {
        //dd($request);
        $rules = [
			'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'exHouse' => 'required|string|max:11',
            'role' => 'required|integer',

        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('users.edit',$user_id)->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
                //dd($user);
                $user = User::find($user_id);

                $user->name = !empty($data['name']) ? $data['name'] : '' ;
                $user->email = !empty($data['email']) ? $data['email'] : '' ;
                $user->ExHouseID = !empty($data['exHouse']) ? $data['exHouse'] : '';
                $user->roleid = !empty($data['role']) ? $data['role'] : '';

				$user->UpdatedBy = $user->user_id;
				$user->updated_at = Carbon::now();
				$user->remember_token = $data['_token'];
                $user->save();
                $user->update($request->all());
                return redirect()->route('users.index')
                                ->with('status','User update successfully.');
			}
			catch(Exception $e){
				return redirect()->route('users.edit',$user_id)->with('failed',"operation failed");
            }
        }
    }


    public function reset($user_id)
    {
        dd($user_id);
    }
}
