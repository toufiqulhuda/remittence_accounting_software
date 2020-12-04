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
        $grpAccs = DB::table('account_group_detail AS ag')
                                ->select('ag.AccGrID','ag.AccGrCode','ag.AccGrName','am.AcctHdName','ex.ExHouseName','cr.username AS CreatedBy','ag.created_at','up.username AS UpdatedBy','ag.updated_at')
                                ->leftJoin('users AS cr', 'ag.CreatedBy', '=', 'cr.user_id')
                                ->leftJoin('users AS up', 'ag.UpdatedBy', '=', 'up.user_id')
                                ->leftJoin('account_main_head AS am', 'ag.AccHdID', '=', 'am.AccHdID')
                                ->leftJoin('exhouse AS ex', 'ag.ExHouseID', '=', 'ex.ExHouseID')
                                ->paginate(5);

        return view('pages.groupAccountCreate',compact('accHeadType','exHouse','grpAccs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
            $accGrMax = DB::select("SELECT case when max(AccGrCode) IS NULL then CONCAT('".$data['accountHeadType']."',LPAD(IFNULL(max(AccGrCode),0)+1,2,0))
                                    when max(AccGrCode) is NOT NULL then max(AccGrCode)+1
                                    END AS  AccGrCode
                                    FROM account_group_detail WHERE AccGrCode LIKE '".$data['accountHeadType']."%'");
            $accGrMaxArr =(array)$accGrMax[0];
            $AccGrCode = $accGrMaxArr['AccGrCode'];
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
