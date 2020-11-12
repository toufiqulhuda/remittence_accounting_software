<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use Illuminate\Support\Facades\Schema;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::select('roleid', 'role_name')->where('isactive','1')->orderBy('roleid')->get();
        //$users = User::latest()->paginate(5);
        $users = DB::table('users AS u')
                    ->leftJoin('users AS cr', 'cr.CreatedBy', '=', 'u.user_id')
                    ->leftJoin('users AS up', 'up.UpdatedBy', '=', 'u.user_id')
                    ->select('u.user_id','u.name','u.email','u.username','u.ExHouseID','u.CountryID','u.roleid',
                    'cr.username AS CreatedBy','u.created_at','u.username AS UpdatedBy','u.updated_at',
                    'u.isactive' )
                    ->paginate(5);
        //dd($users);
        return view('users.index',compact('users','roles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$roles = DB::table('roles')->select('roleid', 'role_name')->orderBy('roleid')->get();
        $roles = Role::select('roleid', 'role_name')->where('isactive','1')->orderBy('roleid')->get();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('users.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $user->delete();

        // return redirect()->route('users.index')
        //                 ->with('success','Product deleted successfully');
    }
}
