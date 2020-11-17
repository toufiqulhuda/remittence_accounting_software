<?php

namespace App\Http\Controllers;

use App\Models\Exhouse;
use App\Models\AccountGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GroupAccountController extends Controller
{

    public function index()
    {
        $accHeadType=DB::table('account_main_head')->select('AccHdID','AcctHdName')->orderBy('AccHdID')->get();
        $exHouse = Exhouse::select('ExHouseID','ExHouseName')->where('isactive','1')->orderBy('ExHouseID')->get();
        return view('pages.groupAccountCreate',compact('accHeadType','exHouse'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //dd($request);
        $rules = [
			'exhouseName' => 'required|string|max:11',
			'AccGrName' => 'required|unique:account_group_detail|string|max:100',
			'accountHeadType' => 'required|string|max:1',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('groupAccount.index')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            $accGrMax = DB::select("SELECT LPAD(IFNULL(max(AccGrID),0)+1,2,0) AS  AccGrID FROM account_group_detail");
            $accGrMaxArr =(array)$accGrMax[0];
            $AccGrCode = $data['accountHeadType'].$accGrMaxArr['AccGrID'];
            //dd($AccGrCode);
            try{
                $authUser = Auth::user();
				$accountGroup = new AccountGroup;
                $accountGroup->AccGrCode = $AccGrCode;
                $accountGroup->ExHouseID = !empty($data['exhouseName']) ? $data['exhouseName'] :'';
                $accountGroup->AccGrName = !empty($data['AccGrName']) ? $data['AccGrName'] : '';
                $accountGroup->AccHdID   = !empty($data['accountHeadType']) ? $data['accountHeadType'] : '';
                //$role->isactive = '';
				$accountGroup->CreatedBy = $authUser->user_id;
                $accountGroup->created_at = Carbon::now();
                $accountGroup->UpdatedBy = null;
				$accountGroup->updated_at = null;
				$accountGroup->remember_token = $data['_token'];
				$accountGroup->save();
                return redirect()->route('groupAccount.index')
                                ->with('status','Group Account created successfully.');
			}
			catch(Exception $e){
				return redirect()->route('groupAccount.index')->with('failed',"operation failed");
			}
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
