<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /********************************
     * Account Transaction
    ***********************************/
    public function accountTransactionCreate()
    {
        $COA=ChartOfAccount::select('COACode','AccountName')->get();
        $vrDate= DB::table('users as u')
                    ->leftjoin('exhouse  as ex','ex.ExHouseID','=','u.ExHouseID')
                    ->selectRAW('DATE_FORMAT(ex.TnxDate,"%d-%b-%Y") AS TnxDate')
                    ->where('u.user_id','=',Auth::user()->user_id)
                    ->first();

        //dd($vrDate);
        return view('pages.accountTransaction',compact('COA','vrDate'));
    }
    public function accountTransactionStore(Request $request)
    {
        dd($request);
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
    /*public function groupAccountEdit()
    {
        return view('pages.groupAccountEdit');
    }
    public function groupAccountUpdate()
    {

    }*/
    /********************************
     * Reverse Transaction
    ***********************************/
    public function reverseTransactionCreate()
    {
        return view('pages.reverseTransaction');
    }
    public function reverseTransactionStore()
    {

    }
    /*public function subGroupAccountEdit()
    {
        return view('pages.subGroupAccountEdit');
    }
    public function subGroupAccountUpdate()
    {

    }*/

}
