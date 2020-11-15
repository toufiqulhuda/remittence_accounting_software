<?php

namespace App\Http\Controllers;

use App\Models\Exhouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HouseKeepingController extends Controller
{
    /********************************
     * GroupAccount
    ***********************************/
    public function groupAccountCreate()
    {
        $accHeadType=DB::table('account_main_head')->select('AccHdID','AcctHdName')->get();
        $exHouse = Exhouse::select('ExHouseID','ExHouseName')->where('isactive','1')->orderBy('ExHouseID')->get();
        return view('pages.groupAccountCreate',compact('accHeadType','exHouse'));
    }
    public function groupAccountStore(Request $request)
    {
        dd($request);
        $rules = [
			'exhouseName' => 'required|string|max:11',
			'accountGName' => 'required|string|max:100',
			'accountHeadType' => 'required|string|max:1',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('groupAccount-create')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $authUser = Auth::user();
				$role = new Role;
                $role->role_name = $data['roleName'];
                //$role->isactive = '';
				$role->CreatedBy = $authUser->user_id;
                $role->created_at = Carbon::now();
                $role->UpdatedBy = null;
				$role->updated_at = null;
				$role->remember_token = $data['_token'];
				$role->save();
                return redirect()->route('groupAccount-create')
                                ->with('status','Group Account created successfully.');
			}
			catch(Exception $e){
				return redirect()->route('groupAccount-create')->with('failed',"operation failed");
			}
        }
    }
    public function groupAccountEdit()
    {
        return view('pages.groupAccountEdit');
    }
    public function groupAccountUpdate()
    {

    }
    /********************************
     * SubGroupAccount
    ***********************************/
    public function subGroupAccountCreate()
    {
        return view('pages.subGroupAccountCreate');
    }
    public function subGroupAccountStore()
    {

    }
    public function subGroupAccountEdit()
    {
        return view('pages.subGroupAccountEdit');
    }
    public function subGroupAccountUpdate()
    {

    }
    /********************************
     * ChartOfAccount
    ***********************************/
    public function chartOfAccountCreate()
    {
        return view('pages.chartOfAccountCreate');
    }
    public function chartOfAccountStore()
    {

    }
    public function chartOfAccountEdit()
    {
        return view('pages.chartOfAccountEdit');
    }
    public function chartOfAccountUpdate()
    {

    }

}
