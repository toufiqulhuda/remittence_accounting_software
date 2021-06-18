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
use App\Http\Controllers\MailController;
use Illuminate\Support\Str;
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
                    ->paginate(20);
        //dd($users);
        return view('users.index',compact('users','roles','exHouse'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }





    public function store(Request $request)
    {
        //dd($request);
        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'exHouse' => 'required|string|max:11',
            'role' => 'required|integer',
            'username' => 'required|unique:users|string|max:20',
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
                $user->password = bcrypt(!empty($data['password']) ? $data['password'] : '');
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
    public function show(){
        //return view('users.show');
    }

    // public function search()
    // {
    //     return view('users.reset');
    // }

    public function showUserInfoByName(Request $request)
    {

        $data = $request->input();
        $userName = !empty($data['username']) ? $data['username'] : "";
        //dd($userName);
        if(!empty($userName)){
            if(($userName=='admin') or ($userName== Auth::user()->username)){
                return redirect()->route('users-search')->with('failed','Operation failed! You have no permission to reset this user.');
            }else{
                $users = DB::table('users AS u')
                ->leftJoin('exhouse AS ex', 'u.ExHouseID', '=', 'ex.ExHouseID')
                ->leftJoin('roles AS r', 'u.roleid', '=', 'r.roleid')
                ->select('u.user_id','u.name','u.email','u.username','ex.ExHouseName','r.role_name', 'u.isactive' )
                ->where('u.username',$userName)
                ->first();
                return view('users.reset',compact('users'));
            }
        }else{
            return view('users.reset');
        }

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

    public function reset(Request $request,$user_id)
    {
        //dd($request);
        $data = $request->input();
        $authUuser = Auth::user();
        $mail = new MailController();
        $user = User::find($user_id);
        $random = trim(Str::random(8));

        $user->password = bcrypt($random);
        $user->UpdatedBy = $authUuser->user_id;
        $user->updated_at = Carbon::now();
        $user->remember_token = $data['_token'];
        $user->save();
        $user->update($request->all());

        $data = array(
            'name'=>$user->name,
            'toEmail'=>$user->email,
            'username'=>$user->username,
            'newPassword'=>$random,
        );

        $mail->reset_email($data);
        return redirect()->route('users.index')
                                ->with('status','User reset successfully.');
    }
    public function isactive(Request $request)
    {
        //dd($request);
        //$user = User::find($user_id);
        $user = User::find($request->id)->update(['isactive' => $request->status]);
        return response()->json(['success'=>'Status changed successfully.']);

    }
    public function userProfile(){
        $userName=Auth::user()->username;
        $users = DB::table('users AS u')
                ->leftJoin('exhouse AS ex', 'u.ExHouseID', '=', 'ex.ExHouseID')
                ->leftJoin('roles AS r', 'u.roleid', '=', 'r.roleid')
                ->select('u.user_id','u.name','u.email','u.username','ex.ExHouseName','r.role_name', 'u.isactive' )
                ->where('u.username',$userName)
                ->first();
        return view('users.show',compact('users'));

    }
    public function changePassword(Request $request){
        //dd($request);
        $data = $request->input();
        $oldpassword = !empty($data['oldpassword']) ? $data['oldpassword'] : "";
        $newpassword = !empty($data['newpassword']) ? $data['newpassword'] : "";
        $password_confirmation = !empty($data['password_confirmation']) ? $data['password_confirmation'] : "";

        if(!empty($oldpassword) && !empty($newpassword) && !empty($password_confirmation)){

            $hashedPassword = Auth::user()->password;
            if(\Hash::check($oldpassword , $hashedPassword )){
                if(!\Hash::check($newpassword , $hashedPassword)){
                    if( $newpassword === $password_confirmation){
                        $authUuser = Auth::user();
                        $user = User::find($authUuser->user_id);
                        $user->password = bcrypt($newpassword );
                        $user->UpdatedBy = $authUuser->user_id;
                        $user->updated_at = Carbon::now();
                        $user->remember_token = $data['_token'];
                        $user->save();
                        $user->update($request->all());

                        return redirect()->route('user-changePass')
                                    ->with('status','Password Changed Successfully.');

                    }else{
                        return redirect()->route('user-changePass')
                                 ->with('failed','New Password and Confirm Password is not the Same.');
                    }

                }else{
                    return redirect()->route('user-changePass')
                                 ->with('failed','Old Password and New Password should be different.');
                }

            }else{
                return redirect()->route('user-changePass')
                                 ->with('failed','Old Password Not matched');
            }
        }else{
            return view('users.changePassword');
        }
    }
}
