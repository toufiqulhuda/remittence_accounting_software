<?php

namespace App\Http\Controllers;

use App\Models\Exhouse;
use App\Models\AccountGroup;
use App\Models\AccountSubGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubGroupAccountController extends Controller
{

    public function index()
    {
         $accGroupType=AccountGroup::select('AccGrID','AccGrName')->get();
         $exHouse = Exhouse::select('ExHouseID','ExHouseName')->where('isactive','1')->orderBy('ExHouseID')->get();
         return view('pages.subGroupAccountCreate',compact('accGroupType','exHouse'));

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
			'AccSbGrName' => 'required|unique:account_sub_group_detail|string|max:100',
			'accountGroupType' => 'required|string|max:1',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('subGroupAccount.index')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            $accSbGrMax = DB::select("SELECT LPAD(IFNULL(max(AccSbGrID),0)+1,2,0) AS  AccSbGrID FROM account_sub_group_detail");
            $AccGrCode = AccountGroup::select('AccGrCode')->where('AccGrID',$data['accountGroupType'])->get();
            $accSbGrMaxArr =(array)$accSbGrMax[0];
            $AccGrCodeData=$AccGrCode[0]->AccGrCode;
            $AccSbGrCode = $AccGrCodeData.$accSbGrMaxArr['AccSbGrID'];
            
            try{
                $authUser = Auth::user();
				$accountSubGroup = new AccountSubGroup;
                $accountSubGroup->AccSbGrCode = $AccSbGrCode;
                $accountSubGroup->ExHouseID = !empty($data['exhouseName']) ? $data['exhouseName'] :'';
                $accountSubGroup->AccSbGrName = !empty($data['AccSbGrName']) ? $data['AccSbGrName'] : '';
                $accountSubGroup->AccGrID   = !empty($data['accountGroupType']) ? $data['accountGroupType'] : '';
                //$role->isactive = '';
				$accountSubGroup->CreatedBy = $authUser->user_id;
                $accountSubGroup->created_at = Carbon::now();
                $accountSubGroup->UpdatedBy = null;
				$accountSubGroup->updated_at = null;
				$accountSubGroup->remember_token = $data['_token'];
				$accountSubGroup->save();
                return redirect()->route('subGroupAccount.index')
                                ->with('status','Sub Group Account created successfully.');
			}
			catch(Exception $e){
				return redirect()->route('subGroupAccount.index')->with('failed',"operation failed");
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
